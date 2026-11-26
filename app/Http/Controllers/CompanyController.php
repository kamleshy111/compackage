<?php
namespace App\Http\Controllers;
use Auth;
use Exception;
use App\Models\BenefitTypes;
use App\Models\{ User, Company };
use App\Http\Controllers\{ Controller, MediaController };
use Illuminate\{ Http\Request, Database\QueryException, Support\Facades\Validator};
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = auth()->user()->companies()->get();
        // $session_permissions = request()->session()->get('route_permissions');
        $permissions = [
            'view'      => auth()->user()->can('company.view'),
            'create'    => auth()->user()->can('company.create'),
            'update'    => auth()->user()->can('company.update'),
            'delete'    => auth()->user()->can('company.delete'),
        ];
        return view('webapp.company.index', compact('companies', 'permissions'));
    }
    /**
     * Show the companies list based on users.
     */
    public function adminIndex()
    {
        $users = User::select('id', 'name')->where('user_role', '!=', 1)->get();
        /*
        $users = User::select('id', 'name')->where('user_role', '!=', 1)->with(['companies' => function($company) {
            $company->select('companies.id', 'companies.name')->withCount('employees');
        }])->get();
         */
        return view('admin.company.index', compact('users'));
    }
    /**
     * Get user companies
     */
    public function adminGetUserCompanies(Request $request)
    {
        $user = User::where('id', $request->user_id)->select('id', 'name')->with(['companies' => function($company) {
            $company->select('companies.id', 'companies.name')->withCount('employees');
        }])->first();
        return send_success(["companies" => $user->companies]);
    }
    public function indexAPI() {
        $companies = auth()->user()->companies()->paginate(pagination_limit());
        $data = [];
        foreach( $companies as $i => $company ) {
            $data['companies'][$i]['id'] = $company->id;
            $data['companies'][$i]['name'] = $company->name;
            $data['companies'][$i]['city'] = $company->city;
            $data['companies'][$i]['state'] = $company->state;
            $data['companies'][$i]['total_reports'] = ($company->reportspackage) ? $company->reportspackage : 0;
            $data['companies'][$i]['reports_left'] = ($company->reports_left) ? $company->reports_left : 0;
        }
        $data['pagination'] = getPaginationObject($companies);
        return send_success($data);
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
        return view('webapp.company.create', compact('permissions'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),
            [
                'name'          =>  'required|string',
                'industry'      =>  'required|string',
                'addr1'         =>  'required|string',
                'city'          =>  'required|string',
                'state'         =>  'required|string',
                'zip'           =>  'required|string',
            ],
            [
                'name.required'     => 'Please enter a company name.',
                'industry.required' => 'Please enter a industry name.',
                'addr1.required'    => 'Please enter Address Line 1.',
                'city.required'     => 'Please enter a City.',
                'state.required'    => 'Please select a State.',
                'zip.required'      => 'Please enter a ZIP.',
            ]
        );
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
        $loggedInUser = auth()->user();
        if( ! empty($request->get('id')) ) {
            $company = Company::find($request->get('id'));
        } else {
            $company = new Company();
        }
        $media_id = 0;
        if ($request->hasFile('image')) {
            try {
                $path = MediaController::imagePath()['user_avatar']['path'];
                $size = MediaController::imagePath()['user_avatar']['size'];
                $media_id = MediaController::uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                return redirect()->back()->with('error', 'Could not upload Image. ' . $exp->getMessage());
            }
        }
        
        $defaultCompany = auth()->user()->defaultCompany();
        // Required
        $company->name                          = $request->name;
        $company->industry                      = $request->industry;
        $company->addr1                         = $request->addr1;
        $company->city                          = $request->city;
        $company->state                         = $request->state;
        $company->zip                           = $request->zip;
        $company->status                        = 1;
        $company->add_id                        = $loggedInUser->id;
        $company->company_owner                 = $loggedInUser->id;
        $company->parent_company_id             = $defaultCompany->id;
        $company->is_super_company              = 0;
        $company->reportspackage                = $defaultCompany->reportspackage;
        $company->reportsadditional             = $defaultCompany->reportsadditional;
        $company->reports_left                  = $defaultCompany->reports_left;
        $company->reports_expire                = $defaultCompany->reports_expire;
        $company->health_census                 = 'Single;;;|Married;;;';
        $company->dental_census                 = 'Single;;;|Married;;;';
        $company->vision_census                 = 'Single;;;|Married;;;';
        
        // Not Required
        $company->addr2                         = ! empty($request->addr2)? $request->addr2 : '';
        $company->day                           = ! empty($request->day)? $request->day : '';
        $company->letter                        = ! empty($request->letter) ? $request->letter : '';
        $company->year                          = ! empty($request->year) ? $request->year : '';
        $company->month                         = ! empty($request->month) ? $request->month : '';
        $company->color1                        = ! empty($request->color1)? $request->color1 : '';
        $company->color2                        = ! empty($request->color2)? $request->color2 : '';
        $company->color3                        = ! empty($request->color3)? $request->color3 : '';
        $company->color4                        = ! empty($request->color4)? $request->color4 : '';
        $company->color5                        = ! empty($request->color5)? $request->color5 : '';
        $company->color1_1                      = ! empty($request->color1_1)? $request->color1_1 : '#000000';
        $company->color2_2                      = ! empty($request->color2_2)? $request->color2_2 : '#000000';
        $company->color3_3                      = ! empty($request->color3_3)? $request->color3_3 : '#000000';
        $company->color4_4                      = ! empty($request->color4_4)? $request->color4_4 : '#000000';
        $company->color5_5                      = ! empty($request->color5_5)? $request->color5_5 : '#000000';
        $company->base_pay_heading              = ! empty($request->base_pay_heading)? $request->base_pay_heading : '';
        $company->other_cash_heading            = ! empty($request->other_cash_heading)? $request->other_cash_heading : '';
        $company->company_paid_heading          = ! empty($request->company_paid_heading)? $request->company_paid_heading : '';
        $company->total_compensation_heading    = ! empty($request->total_compensation_heading)? $request->total_compensation_heading : '';
        $company->telephone                     = ! empty($request->telephone)? $request->telephone : '';
        $company->phone_ext                     = ! empty($request->phone_ext)? $request->phone_ext : '';
        $company->exec_name                     = ! empty($request->exec_name)? $request->exec_name : '';
        $company->exec_name2                    = ! empty($request->exec_name2)? $request->exec_name2 : '';
        $company->exec_name3                    = ! empty($request->exec_name3)? $request->exec_name3 : '';
        $company->disclaimer                    = ! empty($request->disclaimer)? $request->disclaimer : '';
        $company->closing                       = ! empty($request->closing)? $request->closing : '';
        $company->report_footer                 = ! empty($request->report_footer)? $request->report_footer : '';
        $company->exec_position                 = ! empty($request->exec_position)? $request->exec_position : '';
        $company->exec_position2                = ! empty($request->exec_position2)? $request->exec_position2 : '';
        $company->exec_position3                = ! empty($request->exec_position3)? $request->exec_position3 : '';
        $company->currency_symbol               = ! empty($request->currency_symbol)? $request->currency_symbol : '';
        $company->company_designation           = ! empty($request->company_designation)? $request->company_designation : '';
        $company->company_name_email            = !empty($request->company_name_email) ? $request->company_name_email : '';
        $company->dd_field_message_email                = !empty($request->dd_field_message_email) ? $request->dd_field_message_email : '';
        $company->closing_email                 = !empty($request->closing_email) ? $request->closing_email : '';
        $company->exec_name_email               = !empty($request->exec_name_email) ? $request->exec_name_email : '';
        $company->ending_date_label               = !empty($request->ending_date_label) ? $request->ending_date_label : '';
        /*
        $company->base_pay_new_heading                  =   !empty($request->base_pay_new_heading) ? $request->base_pay_new_heading : '';
        $company->other_cash_benefits_heading           =   !empty($request->other_cash_benefits_heading) ? $request->other_cash_benefits_heading : '';
        $company->other_benefits_information_heading    =   !empty($request->other_benefits_information_heading) ? $request->other_benefits_information_heading : '';
        $company->retirement_benefits_total_heading     =   !empty($request->retirement_benefits_total_heading) ? $request->retirement_benefits_total_heading : '';
        */
        $company->base_pay_hourly_heading               =   !empty($request->base_pay_hourly_heading) ? $request->base_pay_hourly_heading : '';
        $company->other_cash_hourly_heading             =   !empty($request->other_cash_hourly_heading) ? $request->other_cash_hourly_heading : '';
        $company->company_paid_hourly_heading           =   !empty($request->company_paid_hourly_heading) ? $request->company_paid_hourly_heading : '';
        $company->company_total_wages_hr_heading           =   !empty($request->company_total_wages_hr_heading) ? $request->company_total_wages_hr_heading : '';
        $company->company_total_wages_heading           =   !empty($request->company_total_wages_heading) ? $request->company_total_wages_heading : '';
        $company->total_compensation_hourly_heading     =   !empty($request->total_compensation_hourly_heading) ? $request->total_compensation_hourly_heading : '';
        $company->welfare_benefits_total_heading        =   !empty($request->welfare_benefits_total_heading) ? $request->welfare_benefits_total_heading : '';
        $company->time_off_benefits_total_heading       =   !empty($request->time_off_benefits_total_heading) ? $request->time_off_benefits_total_heading : '';
        $company->insurance_benefits_total_heading      =   !empty($request->insurance_benefits_total_heading) ? $request->insurance_benefits_total_heading : '';
        $company->special_benefits_total_heading        =   !empty($request->special_benefits_total_heading) ? $request->special_benefits_total_heading : '';
        $company->benefits_total_heading                =   !empty($request->benefits_total_heading) ? $request->benefits_total_heading : '';

        /** hourly Pay labels */
        $company->other_benefits_information_heading_hourly         =   !empty($request->other_benefits_information_heading_hourly) ? $request->other_benefits_information_heading_hourly : '';
        $company->other_cash_benefits_heading_hourly                =   !empty($request->other_cash_benefits_heading_hourly) ? $request->other_cash_benefits_heading_hourly : '';
        $company->base_pay_new_heading_hourly                       =   !empty($request->base_pay_new_heading_hourly) ? $request->base_pay_new_heading_hourly : '';
        $company->welfare_benefits_total_heading_hourly             =   !empty($request->welfare_benefits_total_heading_hourly) ? $request->welfare_benefits_total_heading_hourly : '';
        $company->time_off_benefits_total_heading_hourly            =   !empty($request->time_off_benefits_total_heading_hourly) ? $request->time_off_benefits_total_heading_hourly : '';
        $company->insurance_benefits_total_heading_hourly           =   !empty($request->insurance_benefits_total_heading_hourly) ? $request->insurance_benefits_total_heading_hourly : '';
        $company->special_benefits_total_heading_hourly             =   !empty($request->special_benefits_total_heading_hourly) ? $request->special_benefits_total_heading_hourly : '';
        $company->retirement_benefits_total_heading_hourly          =   !empty($request->retirement_benefits_total_heading_hourly) ? $request->retirement_benefits_total_heading_hourly : '';

        $company->base_pay_new_heading                  =   !empty($request->base_pay_new_heading) ? $request->base_pay_new_heading : '';
        $company->other_cash_benefits_heading           =   !empty($request->other_cash_benefits_heading) ? $request->other_cash_benefits_heading : '';
        $company->other_benefits_information_heading    =   !empty($request->other_benefits_information_heading) ? $request->other_benefits_information_heading : '';
        $company->retirement_benefits_total_heading     =   !empty($request->retirement_benefits_total_heading) ? $request->retirement_benefits_total_heading : '';

        try {
            $company->save();
            $company->users()->syncWithoutDetaching([$loggedInUser->id => ['add_id' => $loggedInUser->id, 'permission_type' => 'admin', 'status' => 1]]);
            // Copy company benefits from the global benefits.
            $company->copyGlobalBenefits();
            if( $request->wantsJson() ){
                return send_success(["msg" => 'Company successfully created.' , 'id' => $company->id, 'redirect' => route('webapp.company')]);
            } else {
                return redirect()->back()->with(['success' => 'Company successfully created.']);
            }
        } catch(QueryException $ex) {
            if( $request->wantsJson() ){
                return send_error(["msg" => $ex->getMessage() , 'redirect' => route('webapp.company')]);
            } else {
                return redirect()->back()->with(['error' => $ex->getMessage()]);
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() //$id
    {
        if( auth()->user()->metas() ) {
            $id = request()->session()->get('user_permissions')['current_user_company_id'];
            if( empty( $id ) && $id == 0 ) {
                $id = auth()->user()->currentSessionCompany();
            }
            $company = Company::findOrFail($id);
            if( ! empty( $company->logo ) && $company->logo > 0 ) {
                $company->logo_url = $company->getAttachment($company->logo);
            }
            // dd($company);
            $permissions = [
                'view'      => auth()->user()->can('company.view'),
                'create'    => auth()->user()->can('company.create'),
                'update'    => auth()->user()->can('company.update'),
                'delete'    => auth()->user()->can('company.delete'),
            ];
            return view('webapp.company.edit', compact('company', 'permissions'));
        }
        return redirect()->route('webapp.company');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = [
            'view'      => auth()->user()->can('company.view'),
            'create'    => auth()->user()->can('company.create'),
            'update'    => auth()->user()->can('company.update'),
            'delete'    => auth()->user()->can('company.delete'),
        ];
        $company = Company::findOrFail($id);
        if( ! empty( $company->logo ) && $company->logo > 0 ) {
            $company->logo_url = $company->getAttachment($company->logo);
        }
        
        return view('webapp.company.edit', compact('company', 'permissions'));
    }
    /**
     * Show the companies details.
     */
    public function adminEdit( $id )
    {
        if( empty($id) ) {
            abort(403, 'Error in fetching company with this ID.');
        }
        $company = Company::where('id', $id)->with("employees")->first();
        if( ! empty( $company->logo ) && $company->logo > 0 ) {
            $company->logo_url = $company->getAttachment($company->logo);
        }
        /* $users = User::select('id', 'name')->where('user_role', '!=', 1)->with(['companies' => function($company) {
            $company->select('companies.id', 'companies.name')->withCount('employees');
        }])->get(); */
        return view('admin.company.edit', compact('company'));
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
        // dd($request->all());
        $fields = [
            'name'          =>  'required|string',
            'industry'      =>  'required|string',
            'addr1'         =>  'required|string',
            'city'          =>  'required|string',
            'state'         =>  'required|string',
            'zip'           =>  'required|string',
            // 'logo'          =>  'mimes:jpeg,jpg,png,gif,bmp,webp'
        ];
        $fields_messages = [
            'name.required'     => 'Please enter a company name.',
            'industry.required' => 'Please enter a industry name.',
            'addr1.required'    => 'Please enter Address Line 1.',
            'city.required'     => 'Please enter a City.',
            'state.required'    => 'Please select a State.',
            'zip.required'      => 'Please enter a ZIP.',
            // 'logo'              => 'Unsupported image type, please upload JPG, PNG, GIF, BMP or WebP files.'
        ];
        if ($request->hasFile('logo')) {
            $fields['logo'] = 'mimes:jpeg,jpg,png,gif,bmp,webp';
            $fields_messages['logo.mimes'] = 'Unsupported image type, please upload JPG, PNG, GIF, BMP or WebP files.';
        }
        $validator = Validator::make($request->all(), 
            $fields,
            $fields_messages
        );
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
        $loggedInUser = auth()->user();
        $company = Company::find($id);
        if( empty($company) ) {
            return send_error(["msg" => 'Company is invaild']);
        }
        $media_id = 0;
        if ($request->hasFile('logo')) {
            try {
                $path = MediaController::imagePath()['user_avatar']['path'];
                $size = '';//'240x130';
                $media_id = MediaController::uploadImage($request->logo, $path, $size, $company->logo);
                $company->logo = $media_id;
            } catch (Exception $exp) {
                dd($exp->getMessage());
                return redirect()->back()->with('error', 'Could not upload Image. ' . $exp->getMessage());
            }
        }
        // dd('t', $request->all());
        //
        // Required
        $company->name                          = $request->name;
        $company->industry                      = $request->industry;
        $company->addr1                         = $request->addr1;
        $company->city                          = $request->city;
        $company->state                         = $request->state;
        $company->zip                           = $request->zip;
        $company->status                        = 1;
        $company->add_id                        = $loggedInUser->id;
        // $company->company_owner                 = $loggedInUser->id;
        
        
        // Not Required
        
        $company->addr2                         = ! empty($request->addr2)? $request->addr2 : '';
        $company->day                           = ! empty($request->day)? $request->day : '';
        $company->letter                        = ! empty($request->letter) ? $request->letter : '';
        $company->year                          = ! empty($request->year) ? $request->year : '';
        $company->month                         = ! empty($request->month) ? $request->month : '';
        $company->color1                        = ! empty($request->color1)? $request->color1 : '';
        $company->color2                        = ! empty($request->color2)? $request->color2 : '';
        $company->color3                        = ! empty($request->color3)? $request->color3 : '';
        $company->color4                        = ! empty($request->color4)? $request->color4 : '';
        $company->color5                        = ! empty($request->color5)? $request->color5 : '';
        $company->color1_1                      = ! empty($request->color1_1)? $request->color1_1 : '#000000';
        $company->color2_2                      = ! empty($request->color2_2)? $request->color2_2 : '#000000';
        $company->color3_3                      = ! empty($request->color3_3)? $request->color3_3 : '#000000';
        $company->color4_4                      = ! empty($request->color4_4)? $request->color4_4 : '#000000';
        $company->color5_5                      = ! empty($request->color5_5)? $request->color5_5 : '#000000';
        $company->base_pay_heading              = ! empty($request->base_pay_heading)? $request->base_pay_heading : '';
        $company->other_cash_heading            = ! empty($request->other_cash_heading)? $request->other_cash_heading : '';
        $company->company_paid_heading          = ! empty($request->company_paid_heading)? $request->company_paid_heading : '';
        $company->total_compensation_heading    = ! empty($request->total_compensation_heading)? $request->total_compensation_heading : '';
        $company->telephone                     = ! empty($request->telephone)? $request->telephone : '';
        $company->phone_ext                     = ! empty($request->phone_ext)? $request->phone_ext : '';
        $company->exec_name                     = ! empty($request->exec_name)? $request->exec_name : '';
        $company->exec_name2                    = ! empty($request->exec_name2)? $request->exec_name2 : '';
        $company->exec_name3                    = ! empty($request->exec_name3)? $request->exec_name3 : '';
        $company->disclaimer                    = ! empty($request->disclaimer)? $request->disclaimer : '';
        $company->closing                       = ! empty($request->closing)? $request->closing : '';
        $company->report_footer                 = ! empty($request->report_footer)? $request->report_footer : '';
        $company->exec_position                 = ! empty($request->exec_position)? $request->exec_position : '';
        $company->exec_position2                = ! empty($request->exec_position2)? $request->exec_position2 : '';
        $company->exec_position3                = ! empty($request->exec_position3)? $request->exec_position3 : '';
        $company->currency_symbol               = ! empty($request->currency_symbol)? $request->currency_symbol : '';
        $company->company_designation           = ! empty($request->company_designation)? $request->company_designation : '';
        
        $company->company_name_email            = ! empty($request->company_name_email) ? $request->company_name_email : '';
        $company->dd_field_message_email        = ! empty($request->dd_field_message_email) ? $request->dd_field_message_email : '';
        $company->closing_email                 = ! empty($request->closing_email) ? $request->closing_email : '';
        $company->exec_name_email               = ! empty($request->exec_name_email) ? $request->exec_name_email : '';
        $company->ending_date_label             = ! empty($request->ending_date_label) ? $request->ending_date_label : '';
        /*
        $company->base_pay_new_heading                  =   !empty($request->base_pay_new_heading) ? $request->base_pay_new_heading : '';
        $company->other_cash_benefits_heading           =   !empty($request->other_cash_benefits_heading) ? $request->other_cash_benefits_heading : '';
        $company->other_benefits_information_heading    =   !empty($request->other_benefits_information_heading) ? $request->other_benefits_information_heading : '';
        $company->retirement_benefits_total_heading     =   !empty($request->retirement_benefits_total_heading) ? $request->retirement_benefits_total_heading : '';
        */
        $company->base_pay_hourly_heading               =   !empty($request->base_pay_hourly_heading) ? $request->base_pay_hourly_heading : '';
        $company->other_cash_hourly_heading             =   !empty($request->other_cash_hourly_heading) ? $request->other_cash_hourly_heading : '';
        $company->company_paid_hourly_heading           =   !empty($request->company_paid_hourly_heading) ? $request->company_paid_hourly_heading : '';
        $company->company_total_wages_hr_heading           =   !empty($request->company_total_wages_hr_heading) ? $request->company_total_wages_hr_heading : '';
        $company->company_total_wages_heading           =   !empty($request->company_total_wages_heading) ? $request->company_total_wages_heading : '';
        $company->total_compensation_hourly_heading     =   !empty($request->total_compensation_hourly_heading) ? $request->total_compensation_hourly_heading : '';
        
        $company->welfare_benefits_total_heading        =   !empty($request->welfare_benefits_total_heading) ? $request->welfare_benefits_total_heading : '';
        $company->time_off_benefits_total_heading       =   !empty($request->time_off_benefits_total_heading) ? $request->time_off_benefits_total_heading : '';
        $company->insurance_benefits_total_heading      =   !empty($request->insurance_benefits_total_heading) ? $request->insurance_benefits_total_heading : '';
        $company->special_benefits_total_heading        =   !empty($request->special_benefits_total_heading) ? $request->special_benefits_total_heading : '';
        $company->benefits_total_heading                =   !empty($request->benefits_total_heading) ? $request->benefits_total_heading : '';

        /** hourly Pay labels */
        $company->other_benefits_information_heading_hourly         =   !empty($request->other_benefits_information_heading_hourly) ? $request->other_benefits_information_heading_hourly : '';
        $company->other_cash_benefits_heading_hourly                =   !empty($request->other_cash_benefits_heading_hourly) ? $request->other_cash_benefits_heading_hourly : '';
        $company->base_pay_new_heading_hourly                       =   !empty($request->base_pay_new_heading_hourly) ? $request->base_pay_new_heading_hourly : '';
        $company->welfare_benefits_total_heading_hourly             =   !empty($request->welfare_benefits_total_heading_hourly) ? $request->welfare_benefits_total_heading_hourly : '';
        $company->time_off_benefits_total_heading_hourly            =   !empty($request->time_off_benefits_total_heading_hourly) ? $request->time_off_benefits_total_heading_hourly : '';
        $company->insurance_benefits_total_heading_hourly           =   !empty($request->insurance_benefits_total_heading_hourly) ? $request->insurance_benefits_total_heading_hourly : '';
        $company->special_benefits_total_heading_hourly             =   !empty($request->special_benefits_total_heading_hourly) ? $request->special_benefits_total_heading_hourly : '';
        $company->retirement_benefits_total_heading_hourly          =   !empty($request->retirement_benefits_total_heading_hourly) ? $request->retirement_benefits_total_heading_hourly : '';

        $company->base_pay_new_heading                  =   !empty($request->base_pay_new_heading) ? $request->base_pay_new_heading : '';
        $company->other_cash_benefits_heading           =   !empty($request->other_cash_benefits_heading) ? $request->other_cash_benefits_heading : '';
        $company->other_benefits_information_heading    =   !empty($request->other_benefits_information_heading) ? $request->other_benefits_information_heading : '';
        $company->retirement_benefits_total_heading     =   !empty($request->retirement_benefits_total_heading) ? $request->retirement_benefits_total_heading : '';
        try {
            $company->save();
            $company->users()->syncWithoutDetaching([$loggedInUser->id => ['add_id' => $loggedInUser->id, 'permission_type' => 'admin', 'status' => 1]]);
            if( $request->wantsJson() ){
                return send_success(["msg" => 'Company successfully created.' , 'id' => $company->id, 'redirect' => route('webapp.company')]);
            } else {
                return redirect()->back()->with(['success' => 'Company successfully created.']);
            }
        } catch(QueryException $ex) {
            if( $request->wantsJson() ){
                return send_error(["msg" => $ex->getMessage() , 'redirect' => route('webapp.company')]);
            } else {
                return redirect()->back()->with(['error' => $ex->getMessage()]);
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Get all the related companies of a user by id
     */
    function getCompaniesByUserAPI( $user_id ) {
        $companies = User::findOrFail($user_id)->companies()->get()->toArray();
        if( request()->wantsJson() ){
            return send_success($companies);
        } else {
            return $companies;
        }
    }
    /**
     * Company Switch using usermeta
     */
    public function switchCompany($comapny_id)
    {
        if( ! Auth::check() ) {
            return send_error(['msg' => "You don't have sufficient permissions to access this area."]);    
        }
        
        $company = Company::find($comapny_id);
        
        if( ! empty($company) ) {
            /** Saving current user company in the usermeta and session */
            $response = CommonController::getUpdateCompanySession($company->id);
            if( $response['access_code'] == 1 ) {
                return send_success(['msg' => 'Successfully switched the company.']);
            }
        }
        return send_error(['msg' => 'Unable to switch the company.']);
    }
}
