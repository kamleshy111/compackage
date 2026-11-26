<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Benefit;
use App\Models\Company;
use App\Models\Employee;
use App\Models\BenefitTypes;
use Illuminate\Http\Request;
use App\Models\CustomCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DigitalDeliveryNotification;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PDFReportController;
use App\Models\Sales\Sales;

use App\Jobs\GenerateCombinedPdfReport;
use App\Models\PdfJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = [
            'view'      => auth()->user()->can('company.view'),
            'create'    => auth()->user()->can('company.create'),
            'update'    => auth()->user()->can('company.update'),
            'delete'    => auth()->user()->can('company.delete'),
            'user_permissions' => request()->session()->get('user_permissions')
        ];
        
        $company = Company::find( auth()->user()->currentSessionCompany() );
        $employees = $company->employees()->paginate(pagination_limit());

        $supervisors = [];
        foreach( $company->employees as $employee ) {
            if( ! in_array( $employee->supervisor, $supervisors ) ) {
                if( ! empty( $employee->supervisor ) ) {
                    $supervisors[] = $employee->supervisor;
                }
            }
        }

        $companies = auth()->user()->defaultCompanygetall();
        $totalReport = 0;
        $totalRemaining = 0;
        
        foreach ($companies as $companyreport) {
            if($companyreport->signup_date->diffInDays($companyreport->reports_expires, false) > 0) {
                $totalRemaining += $companyreport->reports;
            }
            $totalReport += $companyreport->reports;
        }

        $pagination = [
            'total' => $employees->total(),
            'per_page' => $employees->perPage(),
            'current_page' => $employees->currentPage(),
            'last_page' => $employees->lastPage(),
            'from' => $employees->firstItem(),
            'to' => $employees->lastItem()
        ];
        // dd();
        $totalReport = ($company->reportspackage);
        $totaladditionalReport = ($company->reportsadditional);
        $empcount = $company->employees()->count();
        $activeempcount = $company->employees()->where('inactive', 0)->count();
        $inactiveempcount = $company->employees()->where('inactive', 1)->count();
        $final_commited_employee_count = $company->employees()->where('final_commited', 1)->count();
        $totalRemaining = $totalRemaining - $empcount;

        /** New code update report */
        $companies = auth()->user()->defaultCompanygetall();
        $company = auth()->user()->defaultCompany();
        $employee = auth()->user()->employeesgetall();

        return view('webapp.employee.index', compact('employees', 'permissions', 'supervisors', 'pagination', 'companies', 'company', 'employee', 'empcount', 'activeempcount', 'inactiveempcount', 'totalReport', 'final_commited_employee_count', 'totaladditionalReport'));
    }

    public function getAllCompanyEmployees(Request $request)
    {
        $paginationLimit = $request->limit;
        $company = Company::find( auth()->user()->currentSessionCompany() );
        $employees = $company->employees();
        $employees = $employees->get();
        $return_emp_data = [];
        $count_emp = 0;
        $return_data_head = array(
                                'First Name','Last Name','Address Line 1','Address Line 2','City','State','ZIP','Email','Supervisor','Descriptive Qualifier','Hourly','Digital Delivery','Digital Delivery ID','Include Middle Wages Top Box Score
'
                                );
        foreach ($employees as $emp_val ){
            
            $return_emp_data_temp = array(
                                'firstname' => $emp_val->firstname,
                                'lastname' => $emp_val->lastname,
                                'address_line_1' => $emp_val->address_line_1,
                                'address_line_2' => $emp_val->address_line_2,
                                'city' => $emp_val->city,
                                'state' => $emp_val->state,
                                'zip' => $emp_val->zip,
                                'email' => $emp_val->email,
                                'supervisor' => $emp_val->supervisor,
                                'mid_year_event' => $emp_val->mid_year_event,
                                'hourly_pay_functionality' => $emp_val->hourly_pay_functionality,
                                'is_digital_delivery' => $emp_val->is_digital_delivery,
                                'digital_delivery_value' => $emp_val->digital_delivery_value,
                                'is_middle_wages_top_box' => $emp_val->is_middle_wages_top_box,
                                );
            
            $results = DB::table('benefits as ben')
                ->join('benefit_employee as empb', 'ben.id', '=', 'empb.benefit_id')
                ->select('ben.name', 'empb.employer_default_value')
                ->where('empb.employee_id', $emp_val->id)
                ->get();
            
            foreach ($results as $result) {
                if( $count_emp == 0 ){
                    $return_data_head[] = $result->name;
                }
                $benefit_name = str_replace(" ", "_", $result->name);
                if( $benefit_name == '401K'){
                    $benefit_name = "four_zero_one_k";
                }
                $return_emp_data_temp[$benefit_name] = $result->employer_default_value;
            }
            $return_emp_data[]= $return_emp_data_temp;
            $count_emp++;            
        }
        
        return send_success(["employees" => $return_emp_data,"head_data" => $return_data_head ]);
        
    }

    public function getDefaultCompanyEmployees(Request $request) {
        $paginationLimit = $request->limit;
        $company = Company::find( auth()->user()->currentSessionCompany() );
        $employees = $company->employees();

        if( ! empty($request->status) ) {
            if( $request->status == 'active' ) {
                $employees = $employees->where('inactive', 0);
            } else if( $request->status == 'inactive' ) {
                $employees = $employees->where('inactive', 1);
            }
        } else {
            $employees = $employees->where('inactive', 0);
        }

        if( ! empty($request->ddfilter) ) {
            if( $request->ddfilter == 'digital' ) {
                $is_digital_delivery = 1;
                $employees = $employees->where('is_digital_delivery', $is_digital_delivery);
            } else if( $request->ddfilter == 'print' ) {
                $is_digital_delivery = 0;
                $employees = $employees->where('is_digital_delivery', $is_digital_delivery);
            }
            
            if( ! empty($request->supervisor) ) {
                $employees = $employees->where('supervisor', $request->supervisor)->get();
            } else {
                $employees = $employees->get();
            }
            return send_success(["employees" => $employees->values()]);
        } else if( ! empty($request->supervisor) ) {
            $employees = $employees->where('supervisor', $request->supervisor)->get();
            return send_success(["employees" => $employees->values()]);
        } else {

            if( ! empty( $paginationLimit ) && $paginationLimit == 'all' ) {
                $paginationLimit = 5000;
            }
            
            $employees = $employees->paginate($paginationLimit);
    
            $pagination = [
                'total' => $employees->total(),
                'per_page' => $employees->perPage(),
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'from' => $employees->firstItem(),
                'to' => $employees->lastItem()
            ];

            return send_success(["employees" => $employees->values(), "pagination" => $pagination]);
        }
    }

    /** New code SM start */
        /** Search user */
        public function SearchUser(Request $request)
        {
            $searchvalue        = $request->searchvalue;
            $selectedSearchBy   = $request->selectedSearchBy;
            $result = '';
            if(!empty($selectedSearchBy) && $selectedSearchBy == 'Email')
            {
                $result = User::where('email', 'like', '%' . $searchvalue . '%')->get();
            }
            else if(!empty($selectedSearchBy) && $selectedSearchBy == 'FirstLastName')
            {
                $result = User::where('name', 'like', '%' . $searchvalue . '%')->get();
                
            }
            else if(!empty($selectedSearchBy) && $selectedSearchBy == 'Company')
            {
                $user_data_array = [];
                $result = [];
                //$companies = Company::where('name', 'like', '%' . $searchvalue . '%')->get();
                $sales_rec = Sales::where('company_name', 'like', '%' . $searchvalue . '%')->with('user') ->get();
    
                if(!empty($sales_rec))
                {
                    foreach ($sales_rec as $sale) 
                    {
                        $user = $sale->user; 
                        if (!empty($user)) 
                        {
                            $user_data_array[] = $user->toArray();
                        }
                    }
                }
    
                $user_id_arr = [];
                $result = []; // Initialize the $result array
    
                if (!empty($user_data_array)) {
                    foreach ($user_data_array as $user_data) {
                        if (!empty($user_data['id'])) {
                            $user_id_arr[] = $user_data['id'];  // Store only the 'id' values in $user_id_arr
                        }
                    }
                }
    
                // Remove duplicates from $user_id_arr
                $user_id_arr = array_unique($user_id_arr);
    
                // Loop through unique 'id' values and fetch corresponding user data
                foreach ($user_id_arr as $user_id) {
                    $result[] = $this->getUserDataById($user_data_array, $user_id);
                }
    
            }
            
            return json_encode(["success" => true , 'data' => $result ]);
        }

         // Function to get user data by id
        public function getUserDataById($user_data_array, $user_id) {
            foreach ($user_data_array as $user_data) {
                if (!empty($user_data['id']) && $user_data['id'] == $user_id) {
                    return $user_data;
                }
            }
            return null; // Return null if user data is not found
        }

        public function UserIDCompanyID(Request $request)
        {
            try {
                if (!empty($request->UserID)) {
                    $companyIds = Company::where('company_owner', $request->UserID)->pluck('id');
    
                    if(!empty($companyIds))
                    {
                        return response()->json(["success" => true, 'data' => $companyIds]);
                    }
                    else
                    {
                        return response()->json(["error" => false, "message" => "No record found."]);    
                    }
    
                } else {
                    return response()->json(["error" => false, "message" => "UserID is required"]);
                }
            } catch (\Exception $e) {
                return response()->json(["error" => false, "message" => $e->getMessage()]);
            }
        }

        /** Uncommitted Employees */
        public function unCommitted(Request $request)
        {
            if (empty($request->employee_ids)) {
                return send_error(['msg' => "Please select at least one employee."]);
            }
        
            try {
                if (!empty($request->employee_ids)) {
                    if (is_array($request->employee_ids)) {
                        foreach ($request->employee_ids as $id) {
                            $employee = Employee::where('id', $id)->first();
                            if ($employee) {
                                $employee->final_commited = 0;
                                $employee->save();
                            }
                        }
                    } else {
                        $employee = Employee::where('id', $request->employee_ids)->first();
    
                            if ($employee) {
                                $employee->final_commited = 0;
                                $employee->save();
                            }
                    }
                }
        
                return send_success(["msg" => "Employees Uncommitted successfully."]);
            } catch (Exception $ex) {
                return send_error(['msg' => $ex->getMessage()]);
            }
        }
    /** New code SM End */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        $users = User::select('id', 'name')->where('user_role', '!=', 1)->with(['companies' => function($company) {
            $company->select('companies.id', 'companies.name');
        }])->get();
        return view('admin.employee.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = [
            'view'      => auth()->user()->can('company.view'),
            'create'    => auth()->user()->can('company.create'),
            'update'    => auth()->user()->can('company.update'),
            'delete'    => auth()->user()->can('company.delete'),
        ];
        $can_create_employee = auth()->user()->canCreateEmployee();
        //dd($can_create_employee);
        //return view('webapp.employee.create', compact('permissions'));
        
        if( $can_create_employee ) {
            return view('webapp.employee.create', compact('permissions'));
        } else {
            return redirect()->route('webapp.employee.index');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        if($validator->fails()) {
			$error_msg = $validator->errors()->first();
			return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => $error_msg, 
                    "key" => $validator->errors()->keys()[0]
                ]
            ]);
		}

        $employee = new Employee();
        $employee->company_id = auth()->user()->currentSessionCompany();
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address_line_1 = $request->address_line_1;
        $employee->address_line_2 = $request->address_line_2;
        $employee->city = $request->city;
        $employee->state = $request->state;
        $employee->zip = $request->zip;
        $employee->mid_year_event = $request->mid_year_event;
        $employee->group = $request->group;
        $employee->inactive = ! empty($request->inactive) ? $request->inactive : 0;
        $employee->is_digital_delivery = $request->is_digital_delivery;
        $employee->digital_delivery_value = $request->digital_delivery_value;
        $employee->hourly_pay_functionality = $request->hourly_pay_functionality;
        $employee->is_middle_wages_top_box = $request->is_middle_wages_top_box;
        $employee->supervisor = $request->supervisor;
        $employee->employee_id = $request->employee_id;
        $employee->saved_since_added = ! empty($request->saved_since_added)? $request->saved_since_added : 1;
        $employee->namehash = ! empty($request->namehash)? $request->namehash : '';
        $employee->ssn = ! empty($request->ssn)? $request->ssn : '';
        $employee->s_13_job_class = ! empty($request->s_13_job_class)? $request->s_13_job_class : '';
        $employee->s_13_rate = ! empty($request->s_13_rate)? $request->s_13_rate : '';
        $employee->s_17_payrolls = ! empty($request->s_17_payrolls)? $request->s_17_payrolls : '';
        $employee->s_17_perPayCost = ! empty($request->s_17_perPayCost)? $request->s_17_perPayCost : '';
        $employee->s_17_employee_ppc = ! empty($request->s_17_employee_ppc)? $request->s_17_employee_ppc : '';
        $employee->s_18_per_pay_cost = ! empty($request->s_18_per_pay_cost)? $request->s_18_per_pay_cost : '';
        $employee->s_18_employee_ppc = ! empty($request->s_18_employee_ppc)? $request->s_18_employee_ppc : '';
        $employee->s_17_census = ! empty($request->s_17_census)? $request->s_17_census : '';
        $employee->s_19_per_pay_cost = ! empty($request->s_19_per_pay_cost)? $request->s_19_per_pay_cost : '';
        $employee->s_19_employee_ppc = ! empty($request->s_19_employee_ppc)? $request->s_19_employee_ppc : '';
        $employee->is_company_benefit = ! empty($request->is_company_benefit)? $request->is_company_benefit : 0;
        $employee->add_id = auth()->id();
        $employee->save();

        $employee->copyCompanyBenefits();
        
        return send_success(["msg" => 'Successfully created.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        /** If user is admin then, return admin view. */
        if( auth()->user()->isAdmin() ) {
            $employee = Employee::findOrFail($id);
            $company = Company::find($employee->company_id);
            return view('admin.employee.edit', compact('employee', 'company'));
        } else {
            $employee = Employee::where('id', $id)->where('company_id', auth()->user()->currentSessionCompany())->first();
            if( empty( $employee ) ) {
                abort(404);
            }
        }

        $permissions = [
            'view'      => auth()->user()->can('company.view'),
            'create'    => auth()->user()->can('company.create'),
            'update'    => auth()->user()->can('company.update'),
            'delete'    => auth()->user()->can('company.delete'),
        ];
        return view('webapp.employee.edit', compact('employee', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( empty($id) ) {
            return send_error(["msg" => "Invaild employee data."]);
        }

        $employee1 = Employee::find($id);

        if( empty($employee1) ) {
            return send_error(["msg" => "Employee not found."]);
        }

        $isUpdated = $employee1->saveUpdateEmployee($request);

        if( ! empty($isUpdated) && $isUpdated == 1 ) {
            return send_success(["msg" => "Employee updated successfully."]);
        } else {
            return send_error(["msg" => "Employee update failed."]);
        }
    }

    /**
     * Remove the selected employees and their benefits data
     *
     * @param  array  $ids
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete( Request $request ) {
        if( empty($request->employee_ids) ) {
            return send_error(['msg' => "Please select at least one employee."]);
        }

        try{
            if( ! empty( $request->employee_ids ) ) {
                if( is_array($request->employee_ids) ) {
                    foreach( $request->employee_ids as $id ) {
                        Employee::findOrFail($id)->delete();
                    }
                } else {
                    Employee::findOrFail($request->employee_ids)->delete();
                }
            }
            return send_success([ "msg" => "Employees deleted successfully." ]);
        } catch( Exception $ex ) {
            return send_error(['msg' => $ex->getMessage()]);
        }
    }

    /**
     * Getting benefit types and thier benefits with company benefit data.
     * This data will be used to show selected data on the company benefit page.
     */
    public function getBenefitTypes()
    {
        $benefits_from = null;
        $employee = Employee::find(request()->employee_id);

        $employeeBenefitCount = DB::table('benefit_employee')->where('employee_id', $employee->id)->count();
        // Get all benefit types
        $benefitTypes = BenefitTypes::with('benefits')->orderBy('order_sequence', 'ASC')->get();
        $categories = CustomCategory::all()->toArray();

        $loggedinCompany = auth()->user()->currentSessionCompany();
        
        foreach( $benefitTypes as $benefit_type_key => $benefitType ) {
            // Loop through all the benefits under a benefit type.
            foreach( $benefitType->benefits as $order_sequence => $benefit ) {
                // dd($benefit);
                $benefits_from = '';
                $userRelationWithBenefits = '';
                // Get pivot data(relation data)
                if( auth()->user()->isAdmin() ) {
                    $userRelationWithBenefits = $benefit->where('id', $benefit->id)->select('id', 'name', 'calculator', 'benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id')->first();
                    $benefits_from = 'admin';
                } else {
                    if( ! empty($employee) ) {
                        $userRelationWithBenefits = $benefit->employees($employee->id)->withPivot(['benefit_custom_name', 'employer_default_value', 'employee_default_value', 'can_categorize', 'category_id', 'order_sequence'])->first();
                        $cb_benefit = $benefit->companies($loggedinCompany)->withPivot(['benefit_custom_name', 'employee_co_pay', 'show', 'active', 'bold', 'italic', 'add_dollar'])->first();

                        if( ! empty( $cb_benefit ) && ! empty($userRelationWithBenefits) ) {
                            $userRelationWithBenefits->pivot->benefit_custom_name = $cb_benefit->pivot->benefit_custom_name;
                            $userRelationWithBenefits->pivot->employee_co_pay = $cb_benefit->pivot->employee_co_pay;
                        }


                        $benefits_from = 'employee';
                    }

                    if( $employeeBenefitCount == 0 ) {
                        $userRelationWithBenefits = $benefit->companies($loggedinCompany)->withPivot(['benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'order_sequence', 'active','bold', 'italic', 'add_dollar'])->first();
                        $benefits_from = 'company';
                    }

                    if( ! empty( $userRelationWithBenefits ) && ! empty( $userRelationWithBenefits->pivot ) ) {
                        $userRelationWithBenefits = $userRelationWithBenefits->pivot;
                    }
                }
                
                // If found data then, assign to the object.
                if( ! empty($userRelationWithBenefits) ) {
                    $temp = [];
                    $temp['id'] = $benefit->id;
                    $temp['name'] = $benefit->name;
                    $temp['hourly_rate'] = $benefit->hourly_rate;
                    $temp['hourly_hours'] = $benefit->hourly_hours;
                    $temp['hourly_amount'] = $benefit->hourly_amount;
                    

                    if( ! empty( $cb_benefit->pivot->employee_co_pay ) ) {
                        $temp['employee_co_pay'] = ! empty($cb_benefit->pivot->employee_co_pay) ? true : false;
                    }
                    
                    $temp['benefit_custom_name'] = ! empty( $userRelationWithBenefits->benefit_custom_name ) ? $userRelationWithBenefits->benefit_custom_name : '';
                    $temp['employer_default_value']  = ! empty( $userRelationWithBenefits->employer_default_value ) ? number_format($userRelationWithBenefits->employer_default_value, 2, '.', '') : '0.00';
                    $temp['employee_default_value']  = ! empty( $userRelationWithBenefits->employee_default_value ) ? number_format($userRelationWithBenefits->employee_default_value, 2, '.', '') : '0.00';
                    // $temp['order_sequence']          = ! empty( $userRelationWithBenefits->order_sequence ) ? $userRelationWithBenefits->order_sequence : $order_sequence;                    
                    $temp['order_sequence']          = ! empty( $benefit->order_sequence ) ? $benefit->order_sequence : $order_sequence;                    
                    $temp['calculator']              = ! empty( $benefit->calculator ) ? $benefit->calculator : 0;
                    $temp["addedby"]                 = $benefit['addedby'];
                    $temp["bold"]                    = ! empty( $userRelationWithBenefits->bold ) ? true : false;
                    $temp["italic"]                  = ! empty( $userRelationWithBenefits->italic ) ? true : false;
                    $temp["add_dollar"]              = ! empty( $userRelationWithBenefits->add_dollar ) ? true : false;
                    
                    

                    if( ! empty($benefit->category_id) ) {
                        $temp['categories'] = $categories;
                        $temp['category_id'] = $userRelationWithBenefits->category_id;
                        $temp['can_categorize'] = $benefit->can_categorize;
                    }
                    
                    if( ! empty( $cb_benefit ) && ( $cb_benefit->pivot->active != '' ||  $cb_benefit->pivot->show != '') ) {
                        $temp['show'] = ($cb_benefit->pivot->show) ? true : false; //  || ! empty( $cb_benefit->pivot->active )
                        $benefitType->benefits[$order_sequence] = $temp;
                    } else {
                        if( $benefits_from == 'company' ) {
                            if( ! empty( $userRelationWithBenefits->active ) || ! empty( $userRelationWithBenefits->show ) ) {
                                $temp['show'] = (! empty($userRelationWithBenefits->show) || ! empty( $userRelationWithBenefits->show )) ? true : false;
                                $benefitType->benefits[$order_sequence] = $temp;
                            }
                        } else {
                            $benefitType->benefits[$order_sequence]['show'] = false;
                        }
                    }
                } else{
                    if( !empty($cb_benefit) && $cb_benefit->pivot->show != '' ) {
                        $benefitType->benefits[$order_sequence]->show = ($cb_benefit->pivot->show) ? true : false;
                    }
                }
            }
        }

        foreach( $benefitTypes as $benefit_type_key => $benefitType ) {
            $benefitTypes[$benefit_type_key]->show_benefit_type = false;
            foreach( $benefitType->benefits as $benefit ) {
                if( $benefit['show'] ) {
                    $benefitTypes[$benefit_type_key]->show_benefit_type = true;
                }
            }
        }

        // dd($benefitTypes);

        // Return success and error.
        if( ! $benefitTypes->isEmpty() ) {
            return send_success([ "test_dws" => "Developer", "benefitTypes" => $benefitTypes, "benefits_from" => $benefits_from ]);
        } else {
            return send_error(['msg' => 'Something went wrong.']);
        }
    }

    
    public function getCompanyEmployees($company_id)
    {
        $company = Company::findOrFail( $company_id );
        
        $is_inactive = '';

        $employees = $company->employees();
        
        if( request()->filterValue == 'active' ) {
            $is_inactive = 0;
            $employees = $employees->where("inactive", $is_inactive);
        } else if( request()->filterValue == 'inactive' ) {
            $is_inactive = 1;
            $employees = $employees->where("inactive", $is_inactive);
        }

        $employees = $employees->get();

        return send_success(["employees" => $employees]);
    }

    public function getCompanyEmployeesnewsearch($company_id)
    {
        $company = Company::findOrFail( $company_id );
        
        $is_inactive = '';

        $employees = $company->employees();
        
        if( request()->filterValue == 'active' ) {
            $is_inactive = 0;
            $employees = $employees->where("inactive", $is_inactive);
        } else if( request()->filterValue == 'inactive' ) {
            $is_inactive = 1;
            $employees = $employees->where("inactive", $is_inactive);
        }

        $employees = $employees->get();

        return send_success(["employees" => $employees]);
    }

    public function updateEmployeeStatus(Request $request)
    {
        foreach( $request->employees as $id ) {
            $employee = Employee::findOrFail($id);
            if( $request->status == 1 ) {
                $employee->markAsInactive();
            } else {
                $employee->markAsActive();
            }
            $employee->save();
        }
        return send_success(["msg" => "Status updated successfully."]);
    }
    
    /**
     * Calculation for the PDF Reports of employe benefits
     */
    public function createIndividualReport( $employee_id = false ) {

        if( ! empty( $_GET['employee_id'] ) ) {
            // $employee = Employee::find($_GET['employee_id']);
            $employee = Employee::where('id', $_GET['employee_id'])->where('company_id', auth()->user()->currentSessionCompany())->first();
            if( empty( $employee ) ) {
                abort(404);
            }
        } else if( ! empty( $employee_id ) ) {
            $employee = Employee::find($employee_id);
        }
        $exclude_emp = false;
        if( isset( $_GET['exclude_emp'] ) && !empty( $_GET['exclude_emp'] ) && $_GET['exclude_emp'] == 'true' ) {
            $exclude_emp = true;
        }
        if( empty( $employee ) ) {
            return redirect()->back();
        }

        (new PDFReportController)->generate_report( $employee->id, 'show', 'no', $exclude_emp );
        
        return redirect()->back();
        
        /*
        $company = Company::find( auth()->user()->currentSessionCompany() );
        if( $company->canCompanyPrintReports() ) {
            $categories = CustomCategory::get();
            $category_data = [];
            
            foreach( $categories as $category ) {
                $category_data[$category->id] = $category->name;
            }
            
            if( empty( $employee ) && empty( $company ) ) {
                return;
            }
    
            $categories = CustomCategory::all()->toArray();
            
            // Loop through all the benefits under a benefit type.
            $benefits = Benefit::get();

            $employee_benefit_count = DB::table('benefit_employee')->where('employee_id', $employee->id)->count();
            
            $your_base_pay = 0;
            $other_cash_benefits = 0;
            $right_side_employer = 0;
            $right_side_employee = 0;
            $benefitsByCategory = [];
            $employee_benefits_total = 0;
            $employer_benefits_total = 0;
    
            foreach( $benefits as $order_sequence => $benefit ) {
                $userRelationWithBenefits = '';
    
                // Get pivot data(relation data)
                if( ! empty( $employee_benefit_count ) && $employee_benefit_count > 0 ) {
                    $userRelationWithBenefits = $benefit->employees($employee->id)->withPivot(['benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'order_sequence'])->where('show', 1)->first();
                } else {
                    $userRelationWithBenefits = $benefit->companies($company->id)->withPivot(['benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'order_sequence'])->where('show', 1)->first();
                }
    
                if( ! empty( $userRelationWithBenefits ) && ! empty( $userRelationWithBenefits->pivot ) ) {
                    $userRelationWithBenefits = $userRelationWithBenefits->pivot;
                }
                
                // If found data then, assign to the object.
                if( ! empty($userRelationWithBenefits) ) {
                    $temp = [];
                    $temp['id'] = $benefit->id;
                    $temp['name'] = $benefit->name;
                    $temp['show'] = ! empty($userRelationWithBenefits->show) ? true : false;
                    $temp['additional_benefit_name'] = ! empty( $userRelationWithBenefits->benefit_custom_name ) ? $userRelationWithBenefits->benefit_custom_name : '';
                    $temp['employer_default_value']  = ! empty( $userRelationWithBenefits->employer_default_value ) ? $userRelationWithBenefits->employer_default_value : 0;
                    $temp['employee_default_value']  = ! empty( $userRelationWithBenefits->employee_default_value ) ? $userRelationWithBenefits->employee_default_value : 0;
                    $temp['order_sequence']          = ! empty( $userRelationWithBenefits->order_sequence ) ? $userRelationWithBenefits->order_sequence : $order_sequence;                    
                    $temp["addedby"]                 = $benefit['addedby'];
    
                    $employee_benefits_total += $temp['employee_default_value'];
                    $employer_benefits_total += $temp['employer_default_value'];
    
                    if( ! empty($benefit->category_id) ) {
                        $temp['categories'] = $categories;
                        $temp['category_id'] = $userRelationWithBenefits->category_id;
                        $temp['can_categorize'] = $benefit->can_categorize;
                    }
    
                    if( ! empty( $userRelationWithBenefits->category_id ) ) {
                        $benefitsByCategory[$userRelationWithBenefits->category_id][] = $temp;
                        if( $userRelationWithBenefits->category_id == 1 ) {
                            $your_base_pay += $temp['employer_default_value'];
                        } else {
                            $other_cash_benefits += $temp['employer_default_value'];
                        }
    
                        if( ! in_array( $userRelationWithBenefits->category_id, [1,2] ) ) {
                            $right_side_employer += $temp['employer_default_value'];
                            $right_side_employee += $temp['employee_default_value'];
                        }
                    }
                }
            }
            
            $data['employee_benefits_total']    = $employee_benefits_total;
            $data['employer_benefits_total']    = $employer_benefits_total;
            $data['company']                    = $company;
            $data['category']                   = $category_data;
            if( ($right_side_employee + $right_side_employer) > 0 ) {
                $data['cpb_percent']                = number_format(( $right_side_employee / ( $right_side_employee + $right_side_employer) ) * 100, 2);
            } else {
                $data['cpb_percent']                = 0;
            }
    
            if( ($right_side_employee + $right_side_employer) > 0 ) {
                // $data['tcp_percent']                = number_format(($other_cash_benefits/$your_base_pay) * 100, 2);
                $data['tcp_percent']                = number_format(( $other_cash_benefits / ( $your_base_pay + $other_cash_benefits) ) * 100, 2);
            } else {
                $data['tcp_percent']                = 0;
            }
            
            $data['right_left_total']           = ( ($right_side_employee + $right_side_employer) > 0 ) ? $right_side_employee + $right_side_employer : 1;
            $data['company']->logo              = $company->getAttachment();
            $data['benefits_by_category']       = $benefitsByCategory;
            $data['right_side_employer']        = $right_side_employer;
            $data['right_side_employee']        = $right_side_employee;
    
            $category_name = [];
            foreach( $categories as $category ) {
                $category_name[$category['id']] = $category['name'];
            }
            $data['category_name']        = $category_name;
            
            $pdf = PDF::loadView('reports.pdf', $data);
    
            // Put watermark on the PDF.
            if( ! $employee->final_commited ) {
                $pdf->output();
                $canvas = $pdf->getDomPDF()->getCanvas();
                $height = $canvas->get_height();
                $width = $canvas->get_width();
                $canvas->set_opacity(.1,"Multiply");
                $canvas->set_opacity(.1);
                $canvas->page_text($width/5, $height/1.7, 'COMPackage.com', null, 50, array(0,0,0),2,2,-30);
            }
            
            return $pdf->setPaper(paperSize( 'a4' ))->stream();
        } else {
        }*/
    }

    /**
     * Final commit, You can not update or delete employees of that user.
     */
    public function finalCommit(Request $request)
    {
        if( ! empty($request->employees_id) ) {
            try {
                // $user = auth()->user();
                $company_session = request()->session()->get('user_permissions');
                $company = Company::find($company_session['current_user_company_id']);
                
                // $count = 0;
                // Committing users.
                // $employees = $user->defaultCompanyEmployees();
                $employees = Employee::whereIn('id',$request->employees_id)->get();

                $employees->each(function($employee) {
                    if( ! $employee->final_commited ) {
                        $employee->commit();
                        
                        // $count++;
                        // Reducing reports from company
                        // $company->reduceReports($count);
                        // $company->reduceReports(1);
                    }
                });
    
                return send_success(["msg" => "Selected employees are committed successfully."]);
            } catch( Exception $ex ) {
                return send_error(["msg" => $ex->getMessage()]);
            }
        } else {
            return send_error(["msg" => "No records found!!"]);
        }
    }

    /**
     * Changing the status of the employee
     */
    function changeStatus(Request $request) {
        if( empty($request->employee_ids) ) {
            return send_error(['msg' => "Please select at least one employee."]);
        }

        if( empty($request->staus) ) {
            return send_error(['msg' => "Please select a staus."]);
        }

        try{
            if( $request->staus == 'active' ) {
                if( ! empty( $request->employee_ids ) ) {
                    if( is_array($request->employee_ids) ) {
                        foreach( $request->employee_ids as $id ) {
                            Employee::findOrFail($id)->markAsActive();
                        }
                    } else {
                        Employee::findOrFail($request->employee_ids)->markAsActive();
                    }
                }
            } else if( $request->staus == 'inactive' ) {
                if( ! empty( $request->employee_ids ) ) {
                    if( is_array($request->employee_ids) ) {
                        foreach( $request->employee_ids as $id ) {
                            Employee::findOrFail($id)->markAsInactive();
                        }
                    } else {
                        Employee::findOrFail($request->employee_ids)->markAsInactive();
                    }
                }
            }

            return send_success([ "msg" => "Employees status changed successfully." ]);
        } catch( Exception $ex ) {
            return send_error(['msg' => $ex->getMessage()]);
        }
    }

    /**
     * Send email notification to the individual user.
     */
    public function sendDDInstructions( Request $request )
    {
        try {
            $company = auth()->user()->defaultCompany();
            $employee = Employee::find($request->employee['id']);
            if( ! empty( $request->employee['email'] ) ) {
                Mail::to($request->employee['email'])->send(new DigitalDeliveryNotification($employee, $company));
            }
            return send_success([ "msg" => "Notification sent successfully." ]);
        } catch( Exception $ex) {
            return send_error([ "msg" => "Unable to send notification. ERROR: " . $ex->getMessage() ]);
        }
    }

    /**
     * Send bulk email to digital delivery enabled employees
     */
    public function sendBulkEmailToDigitalDelivery(Request $request)
    {
        try {
            $company = auth()->user()->defaultCompany();
            if( ! empty($request->employee_ids) ) {
                foreach($request->employee_ids as $employee_id) {
                    $employee = Employee::find($employee_id);
                    if( $employee->is_digital_delivery ) {
                        if( ! empty( $employee->email ) ) {
                            Mail::to($employee->email)->send(new DigitalDeliveryNotification($employee, $company));
                        }
                    }
                }
            }
            return send_success([ "msg" => "Notifications sent successfully." ]);
        } catch( Exception $ex) {
            return send_error([ "msg" => "Unable to send notification. ERROR: " . $ex->getMessage() ]);
        }
    }

    /** Combined PDF */
    public function AllSelectedPrintPDF(Request $request )
    {
        //$employees = $company->employees()->where('inactive', 0)->get();
        if (!empty($request->employee_id)) {
            $type = 'download';
            $test = 'no';
            $pdfController = new PDFReportController();
            $employee = Employee::find($request->employee_id);
            $data = [];
            if (!empty($employee)) {
                $company = $employee->company()->first();
                if( $company->canCompanyPrintReports() ) {
                    if (!empty($company)) {
                        /** We are including only active and committed employees */
                        if( $employee->final_commited && ($employee->inactive == 0) || ($company->getActivePlan() == 'unlimited' || $company->getActivePlan() == 'professional' || $company->getActivePlan() == 'standard') )
                        {
                            $exclude_emp = false;
                            if( isset( $request->exclude_emp ) && !empty($request->exclude_emp) && $request->exclude_emp == 'true' ) {
                                $exclude_emp = true;
                            }
                            $data['allrecords'] = $pdfController->_individual_pdf_report_combined_pdf($company, $employee, $type, $exclude_emp);
                        }
                    }
                    return send_success($data);
                }
                else
                {
                    return send_success([
                        "msg" => 'The subscription has been expired. Please contact your employer to renew the plan.'
                    ]);
                }
            }
        }
        
        return false;
    }

    /** AllSelectedconvertPDF */
    public function AllSelectedconvertPDF(Request $request)
    {
        //$data_record = [];
        $data = $request->input();
        $data_record['allrecords'] = $data;
        if(!empty($data_record))
        {
            $pdf = PDF::loadView('reports.mergepdf', $data_record);
            $customPaper = array(0, 0, 614, 800);
            $pdf->set_paper($customPaper);
            // Set headers for PDF download
            header("Content-type: application/pdf");
            header("Content-Disposition: attachment; filename=combined.pdf");
            echo $pdf->stream();
        }
    }
    public function queueCombinedReport(Request $request)
    {
        $request->validate([
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:employees,id',
            'exclude_emp' => 'boolean'
        ]);

        $employeeIds = $request->employee_ids;
        $excludeEmp = $request->exclude_emp ?? false;
        $userId = Auth::id();
        
        // Generate unique job ID
        $jobId = Str::uuid()->toString();
        
        // Create job record in database
        $pdfJob = PdfJob::create([
            'job_id' => $jobId,
            'user_id' => $userId,
            'total_employees' => count($employeeIds),
            'processed_employees' => 0,
            'status' => 'pending'
        ]);

        // Dispatch the job to queue
        //GenerateCombinedPdfReport::dispatch($employeeIds, $excludeEmp, $jobId, $userId);
        GenerateCombinedPdfReport::dispatch($jobId, $employeeIds, $userId, $excludeEmp);

        return response()->json([
            'success' => true,
            'job_id' => $jobId,
            'message' => 'Report generation started',
            'employee_count' => count($employeeIds)
        ]);
    }

    public function checkJobStatus($jobId)
    {
        $pdfJob = PdfJob::where('job_id', $jobId)->first();
        
        if (!$pdfJob) {
            return response()->json([
                'error' => 'Job not found'
            ], 404);
        }
        
        $response = [
            'status' => $pdfJob->status,
            'total' => $pdfJob->total_employees,
            'processed' => $pdfJob->processed_employees,
            'percentage' => $pdfJob->total_employees > 0 
                ? round(($pdfJob->processed_employees / $pdfJob->total_employees) * 100) 
                : 0
        ];
        
        // if ($pdfJob->status === 'completed' && $pdfJob->file_path) {
        //     // Return public URL instead of download route
        //     $response['pdf_url'] = asset('storage/' . $pdfJob->file_path);
        // }
        if ($pdfJob->status === 'completed' && $pdfJob->file_path) {
            $response['pdf_url'] = url('/webapp/stream-combined-report/' . $jobId);
        }
        
        if ($pdfJob->status === 'failed') {
            $response['error'] = $pdfJob->error_message;
        }
        
        return response()->json($response);
    }

    public function downloadCombinedReport($jobId)
    {
        $pdfJob = PdfJob::where('job_id', $jobId)->first();
        
        if (!$pdfJob || $pdfJob->status !== 'completed') {
            abort(404, 'Report not found or not ready');
        }
        
        if (!Storage::exists($pdfJob->file_path)) {
            abort(404, 'File not found');
        }
        
        return Storage::download($pdfJob->file_path, 'COMPackage-Combined-Report.pdf');
    }
    // public function streamCombinedReport($jobId)
    // {
    //     $pdfJob = PdfJob::where('job_id', $jobId)->first();
        
    //     if (!$pdfJob || $pdfJob->status !== 'completed') {
    //         abort(404, 'Report not found or not ready');
    //     }
        
    //     $filePath = storage_path('app/public/' . $pdfJob->file_path);
        
    //     if (!file_exists($filePath)) {
    //         abort(404, 'File not found');
    //     }
        
    //     return response()->file($filePath, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'inline; filename="COMPackage-Combined-Report.pdf"'
    //     ]);
    // }
    // public function streamCombinedReport($jobId)
    // {
    //     $pdfJob = PdfJob::where('job_id', $jobId)->first();
        
    //     if (!$pdfJob || $pdfJob->status !== 'completed' || !$pdfJob->file_path) {
    //         abort(404, 'Report not found or not ready');
    //     }
        
    //     $filePath = storage_path('app/public/' . $pdfJob->file_path);
        
    //     if (!file_exists($filePath)) {
    //         abort(404, 'File not found');
    //     }
        
    //     // Delete the PdfJob record from database
    //     $pdfJob->delete();
        
    //     // Use download() instead of file() - this supports deleteFileAfterSend
    //     return response()->download($filePath, 'combined.pdf', [
    //         'Content-Type' => 'application/pdf'
    //     ])->deleteFileAfterSend(true);
    // }
    public function streamCombinedReport($jobId)
    {
        $pdfJob = PdfJob::where('job_id', $jobId)->first();

        if (!$pdfJob || $pdfJob->status !== 'completed' || !$pdfJob->file_path) {
            abort(404, 'Report not found or not ready');
        }

        $filePath = storage_path('app/public/' . $pdfJob->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        // Atomically claim this job so a concurrent duplicate request can't
        // also pass this check while the file/row are still present
        $claimed = PdfJob::where('job_id', $jobId)
            ->where('status', 'completed')
            ->update(['status' => 'delivered']);

        if (!$claimed) {
            abort(404, 'Report already delivered');
        }

        $pdfJob->delete();

        return response()->download($filePath, 'combined.pdf', [
            'Content-Type' => 'application/pdf'
        ])->deleteFileAfterSend(true);
    }
    public function cancelJob($jobId)
    {
        try {
            $pdfJob = PdfJob::where('job_id', $jobId)->first();
            
            if (!$pdfJob) {
                return response()->json(['success' => false, 'message' => 'Job not found']);
            }
            
            // Only cancel if not already completed
            if ($pdfJob->status === 'completed') {
                return response()->json(['success' => false, 'message' => 'Job already completed']);
            }
            
            // Mark as cancelled
            $pdfJob->update([
                'status' => 'cancelled',
                'error_message' => 'Cancelled by user'
            ]);
            
            // Delete any partial files
            if ($pdfJob->file_path && Storage::disk('public')->exists($pdfJob->file_path)) {
                Storage::disk('public')->delete($pdfJob->file_path);
            }
            
            return response()->json(['success' => true, 'message' => 'Job cancelled']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}