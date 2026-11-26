<?php
namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Company;
// use App\Models\Employee;
use App\Models\BenefitTypes;
use Illuminate\Http\Request;
use App\Models\CustomCategory;
use Illuminate\Support\Facades\DB;

class BenefitsController extends Controller
{
    /** Show the benefits list in the Admin and WebApp section based on logged in user. */
    public function index()
    {
        if( auth()->user()->isAdmin() ) {
            return view('admin.benefits.index');
        } else {
            $permissions = [
                'view'      => auth()->user()->can('benefit.view'),
                'create'    => auth()->user()->can('benefit.create'),
                'update'    => auth()->user()->can('benefit.update'),
                'delete'    => auth()->user()->can('benefit.delete'),
            ];
            
            return view('webapp.benefits.index', compact('permissions'));
        }
    }

    /** Store the Benefits values in the Database. */
    public function store(Request $request)
    {
        // Get the logged in company ID
        $loggedinCompany = auth()->user()->currentSessionCompany();

        /** Deleting custom benefits if a user deletes some records */
        if( auth()->user()->isAdmin() ) {
            foreach($request->benefits_to_be_deleted as $benefit_id) {
                $benefit = Benefit::where('id', $benefit_id);
                if( ! empty( $benefit ) ) {
                    $benefit->delete();
                }
            }
        }
        
        /** Loop through the benefit type and benefits to save. */
        foreach( $request->benefits as $benefirType ) {
            foreach($benefirType['benefits'] as $order_sequence => $companyBenefit) {
                $benefit = Benefit::find($companyBenefit['id']);

                /** Pivot data for the company. */
                $pivotArgs = [
                    'add_id'                    => auth()->user()->id,
                    'show'                      => ! empty( $companyBenefit['show'] ) ? 1 : 0 ,
                    'benefit_custom_name'       => ! empty( $companyBenefit['additional_benefit_name'] ) ? $companyBenefit['additional_benefit_name'] : '' ,
                    'employee_co_pay'           => ! empty( $companyBenefit['employee_co_pay'] ) ? true : false ,
                    'employer_default_value'    => ! empty( $companyBenefit['employer_default_value'] ) ? $companyBenefit['employer_default_value'] : 0.00 ,
                    'employee_default_value'    => ! empty( $companyBenefit['employee_default_value'] ) ? $companyBenefit['employee_default_value'] : 0.00,
                    'addedby'                   => ! empty( $companyBenefit['addedby'] ) ? $companyBenefit['addedby'] : '',
                    'order_sequence'            => ! empty( $companyBenefit['order_sequence'] ) ? $companyBenefit['order_sequence'] : $order_sequence,
                    'bold'                      => ! empty( $companyBenefit['bold']) ? true : false,
                    'italic'                    => ! empty( $companyBenefit['italic']) ? true : false,
                    'add_dollar'                => ! empty( $companyBenefit['add_dollar']) ? true : false,
                    'decimal_cents'             => ! empty( $companyBenefit['decimal_cents']) ? true : false
                    
                ];

                // Add catagories list if exists
                if( ! empty($companyBenefit['category_id']) ) {
                    $pivotArgs['category_id'] = $companyBenefit['category_id'];
                    $pivotArgs['can_categorize'] = $companyBenefit['can_categorize'];
                } else {
                    $pivotArgs['category_id'] = 0;
                    $pivotArgs['can_categorize'] = $companyBenefit['can_categorize'];
                }
                
                // Add update benefits for the admin (Data will save to benefits table)
                if( auth()->user()->isAdmin() ) {
                    if( empty( $benefit ) ) {
                        $benefit = new Benefit();
                        $benefit->name = $companyBenefit['name'];
                        $benefit->benefit_type_id = $benefirType['id'];
                        $benefit->calculator = 0;
                    }

                    if( ! empty($companyBenefit['category_id']) ) {
                        $benefit->category_id = $companyBenefit['category_id'];
                        $benefit->can_categorize = $companyBenefit['can_categorize'];
                    }
                    else
                    {
                        $benefit->category_id = $companyBenefit['category_id'];
                    }

                    $benefit->add_id                    = auth()->user()->id;
                    $benefit->show                      = ! empty( $companyBenefit['show'] ) ? 1 : 0;
                    $benefit->benefit_custom_name       = ! empty( $companyBenefit['additional_benefit_name'] ) ? $companyBenefit['additional_benefit_name'] : '';
                    $benefit->employer_default_value    = ! empty( $companyBenefit['employer_default_value'] ) ? $companyBenefit['employer_default_value'] : 0.00;
                    $benefit->employee_co_pay           = ! empty( $companyBenefit['employee_co_pay'] ) ? 1 : 0;
                    $benefit->employee_default_value    = ! empty( $companyBenefit['employee_default_value'] ) ? $companyBenefit['employee_default_value'] : 0.00;
                    $benefit->order_sequence            = ! empty( $companyBenefit['order_sequence'] ) ? $companyBenefit['order_sequence'] : $order_sequence;
                    $benefit->addedby                   = 'admin';
                    $benefit->save();
                } else {
                    // Add update benefits for company.
                    if( empty( $benefit ) ) {
                        $benefit = new Benefit();
                        $benefit->name = $companyBenefit['name'];
                        $benefit->benefit_type_id = $benefirType['id'];
                        $benefit->calculator = 0;
                        $benefit->can_categorize = 1;
                        $benefit->category_id = 1;
                        $benefit->add_id = auth()->id();
                        $benefit->addedby = $loggedinCompany;
                        $benefit->save();
                    }
                    // Saving data to company_benefit table.
                    // print_r($pivotArgs);
                    $benefit->companies()->syncWithoutDetaching( [ auth()->user()->currentSessionCompany() => $pivotArgs ] );
                }
            }
        }

        // Return success.
        return send_success(["msg" => 'Benefits successfully updated.']);
    }

    public function getAllSelectedBenefits( Request $request ){
        $request_type = $request->request_type;
        $loggedinCompany = auth()->user()->currentSessionCompany();
        $company = Company::find($loggedinCompany);
        if( $request_type == "all"){
            $selectedBenefits = $company->benefits()->withPivot('benefit_custom_name','employee_co_pay')->orderBy('benefit_type_id')->get();
        }
        else{
            $selectedBenefits = $company->benefits()->withPivot('benefit_custom_name','employee_co_pay')->where('company_benefit.show', 1)->orderBy('benefit_type_id')->get();
        }
        return send_success(["benefits" => $selectedBenefits]);
    }

    /**
     * Getting benefit types and thier benefits with company benefit data (or admin, if user is logged in using admin user).
     * This data will be used to show selected data on the company benefit page.
     */
    public function getBenefitTypes()
    {
        // Get all benefit types
        $loggedinCompany = auth()->user()->currentSessionCompany();

        // Get the benefit type with benefits for benefits those are added by the admin or the selected company.
        $benefitTypes = BenefitTypes::with([
            'benefits' => fn($benefit) => $benefit->whereIn('addedby', ['admin'])->where('active', 1) //this.benefit_types[benefit_type_index].benefits[benefit_index].company_id
        ])->orderBy('order_sequence', 'ASC')->get();

        // Get the category
        $categories = CustomCategory::all()->toArray();

        foreach( $benefitTypes as $bt_key => $benefitType ) {
            $benefits = $benefitTypes[$bt_key]->benefits;//->sortByDesc('order_sequence');//'order_sequence'

            // Loop through all the benefits under a benefit type.
            foreach( $benefits as $order_sequence => $benefit ) {
                // Get pivot data(relation data)
                if( auth()->user()->isAdmin() ) {
                    $userRelationWithBenefits = $benefit->where('id', $benefit->id)->where('addedby', 'admin')->select('id', 'name', 'calculator', 'order_sequence', 'benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'employee_co_pay')->where('active', 1)->first();
                } else {
                    $userRelationWithBenefits = $benefit->companies($loggedinCompany)->withPivot(['benefit_custom_name', 'employee_co_pay','employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'order_sequence', 'addedby', 'company_id', 'bold', 'italic', 'add_dollar', 'decimal_cents'])->where('company_benefit.company_id', $loggedinCompany)->first();
                    if( ! empty($userRelationWithBenefits) ) {
                        $userRelationWithBenefits = $userRelationWithBenefits->pivot;
                    }
                }
                // If found data then, assign to the object.
                if( ! empty($userRelationWithBenefits) ) {
                    $temp = [];
                    $temp['id']                     = $benefit->id;
                    $temp['name']                   = $benefit->name;
                    $temp['show']                   = ! empty($userRelationWithBenefits->show) ? true : false;
                    $temp['additional_benefit_name']= $userRelationWithBenefits->benefit_custom_name;
                    $temp['employee_co_pay']        = ! empty($userRelationWithBenefits->employee_co_pay) ? true : false;
                    $temp['employer_default_value'] = ! empty($userRelationWithBenefits->employer_default_value) ? $userRelationWithBenefits->employer_default_value : '0.00';
                    $temp['employee_default_value'] = ! empty($userRelationWithBenefits->employee_default_value) ? $userRelationWithBenefits->employee_default_value : '0.00';
                    $temp['addedby']                = ! empty( $userRelationWithBenefits->addedby ) ? $userRelationWithBenefits->addedby : '' ;
                    $temp['order_sequence']         = ! empty( $userRelationWithBenefits->order_sequence ) ? $userRelationWithBenefits->order_sequence : $order_sequence;
                    $temp['company_id']             = ! empty( $userRelationWithBenefits->company_id ) ? $userRelationWithBenefits->company_id : '';
                    $temp['calculator']             = ! empty( $userRelationWithBenefits->calculator ) ? $userRelationWithBenefits->calculator : 0;
                    $temp['bold']                   = ! empty($userRelationWithBenefits->bold) ? true : false;
                    $temp['italic']                 = ! empty($userRelationWithBenefits->italic) ? true : false;
                    $temp['add_dollar']             = ! empty($userRelationWithBenefits->add_dollar) ? true : false;
                    $temp['decimal_cents']          = ! empty($userRelationWithBenefits->decimal_cents) ? true : false;
                    $temp['categories']             = $categories;
                    $temp['category_id']            = $userRelationWithBenefits->category_id;
                    $temp['can_categorize']         = $benefit->can_categorize;

                    $benefitType->benefits[$order_sequence] = $temp;
                } else {
                    $benefit = $benefit->toArray();

                    $benefit['additional_benefit_name'] = ! empty($benefit['benefit_custom_name']) ? $benefit['benefit_custom_name'] : '';
                    $temp['employee_co_pay']            = false;
                    $benefit['employer_default_value']  = ! empty($benefit['employer_default_value']) ? $benefit['employer_default_value'] : '0.00';
                    $benefit['employee_default_value']  = ! empty($benefit['employee_default_value']) ? $benefit['employee_default_value'] : '0.00';
                    $benefit['show']                    = false;
                    $benefit['active']                  = false;
                    $temp['bold']                       = false;
                    $temp['italic']                     = false;
                    $temp['add_dollar']                 = false;
                    $temp['decimal_cents']              = false;
                    $benefit['calculator']              = ! empty( $benefit['calculator'] ) ? $benefit['calculator'] : 0;

                    $benefit['categories']  = $categories;
                    $benefit['company_id']  = $loggedinCompany;
                    $benefit["addedby"]     = $benefit['addedby'];

                    if( ! empty($benefit['can_categorize']) && $benefit['can_categorize'] == 1 ) {
                        $benefit['category_id'] = $benefit['category_id'];
                        $benefit['can_categorize'] = $benefit['can_categorize'];
                    }

                    $benefitType->benefits[$order_sequence] = $benefit;
                }
            }
        }

        // Return success and error.
        if( ! $benefitTypes->isEmpty() ) {
            return send_success(["benefitTypes" => $benefitTypes]);
        } else {
            return send_error(['msg' => 'Something went wrong.']);
        }
    }

    /** Benefits reordering for the Admin and WebApp section. */
    public function benefitsReOrdering( Request $request )
    {
        $benefitType = $request->benefitType;
        
        if( ! empty($request->employee_id) ) {

            $loggedinCompany = auth()->user()->currentSessionCompany();

            foreach( $request->benefit_types as $benefit_type ) {
                if($benefit_type['id'] == $benefitType) {
                    foreach( $benefit_type['benefits'] as $order => $benefit ) {
                        $benefit = Benefit::find($benefit['id']);
                        $benefit->employees()->sync( [ $request->employee_id => ['edit_id' => auth()->user()->id, 'order_sequence' => ($order + 1)] ] );
                    }
                }
            }
            
            $response['status'] = 1;
            $response['message'] = "Collection Ordered Successfully";
            return json_encode($response);
        } else if( auth()->user() && auth()->user()->isAdmin() ) {

            foreach( $request->benefit_types as $benefit_type ) {
                if($benefit_type['id'] == $benefitType) {
                    foreach( $benefit_type['benefits'] as $order => $benefit ) {
                        $benefit = Benefit::find($benefit['id']);
                        $benefit->order_sequence = $order + 1;
                        $benefit->save();
                    }
                }
            }

            $response['status'] = 1;
            $response['message'] = "Collection Ordered Successfully";
            return json_encode($response);
        } else {
            $loggedinCompany = auth()->user()->currentSessionCompany();

            foreach( $request->benefit_types as $benefit_type ) {
                if($benefit_type['id'] == $benefitType) {
                    foreach( $benefit_type['benefits'] as $order => $benefit ) {
                        $benefit = Benefit::find($benefit['id']);
                        $benefit->companies()->sync( [ $loggedinCompany => ['edit_id' => auth()->user()->id, 'add_id' => auth()->user()->id, 'order_sequence' => ($order + 1)] ] );
                    }
                }
            }
            
            $response['status'] = 1;
            $response['message'] = "Collection Ordered Successfully";
            return json_encode($response);
        }
        
    }

    public function getCompanyBenefits($company_id = false) {
        if( $company_id ) {
            $loggedinCompany = $company_id;
        } else {
            $loggedinCompany = auth()->user()->currentSessionCompany();
        }

        $company = Company::find($loggedinCompany);
        $selectedBenefits = $company->benefits()->withPivot('benefit_custom_name', 'category_id', 'employee_co_pay', 'order_sequence', 'bold', 'italic', 'add_dollar', 'decimal_cents')->where('company_benefit.show', 1)->orderBy('benefit_type_id')->get();
        return $selectedBenefits;
    }

    /**
     * Get employee benefits
     */
    public function getEmployeeBenefits($employee) {
        $selectedBenefits = DB::table('benefit_employee')->where('employee_id', $employee->id)->where('benefit_employee.show', 1)->get();
        // $loggedinCompany = auth()->user()->currentSessionCompany();
        // $selectedBenefits = $employee->benefits()->withPivot('benefit_custom_name', 'category_id')->where('benefit_employee.show', 1)->orderBy('benefit_type_id')->get();
        // dd('test', $selectedBenefits);


        // $company = Company::find($loggedinCompany);
        // $selectedBenefits = $company->benefits()->withPivot('benefit_custom_name', 'category_id')->where('company_benefit.show', 1)->orderBy('benefit_type_id')->get();
        // dd($selectedBenefits);
        return $selectedBenefits;
    }
}
