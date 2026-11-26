<?php

namespace App\Models;

use Exception;
use Illuminate\Http\Request;
use App\Models\{Company, Benefit};
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use ESolution\DBEncryption\Traits\EncryptedAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    // use EncryptedAttribute;

    public $timestamps = true;

    /* protected $encryptable = [
        'firstname','lastname','email','phone','address_line_1','address_line_2','city','state','zip','employee_id'
    ]; */
    
    public function saveUpdateEmployee( Request $request ) {
        // try {
            // dd($request->employee);
            if( ! $this->final_commited ) {
                $this->firstname = $request->employee['firstname'];
                $this->lastname = $request->employee['lastname'];
                $this->employee_id = $request->employee['employee_id'];
            }
            
            $this->email = $request->employee['email'];
            $this->phone = $request->employee['phone'];
            $this->address_line_1 = $request->employee['address_line_1'];
            $this->address_line_2 = $request->employee['address_line_2'];
            $this->city = $request->employee['city'];
            $this->state = $request->employee['state'];
            $this->zip = $request->employee['zip'];
            $this->mid_year_event = $request->employee['mid_year_event'];
            $this->group = $request->employee['group'];
            $this->inactive = $request->employee['inactive'];
            $this->hourly_pay_functionality = ! empty($request->employee['hourly_pay_functionality']) ? true : false;
            $this->is_digital_delivery = (! empty($request->employee) && ! empty($request->employee['is_digital_delivery'])) ? 1 : 0;
            $this->digital_delivery_value = (! empty($request->employee) && ! empty($request->employee['digital_delivery_value'])) ? $request->employee['digital_delivery_value'] : '';
            $this->supervisor = (! empty($request->employee) && ! empty($request->employee['supervisor'])) ? $request->employee['supervisor'] : '';
            
            $this->saved_since_added = $request->employee['saved_since_added'];
            $this->namehash = $request->employee['namehash'];
            $this->ssn = $request->employee['ssn'];
            $this->s_13_job_class = $request->employee['s_13_job_class'];
            $this->s_13_rate = $request->employee['s_13_rate'];
            $this->s_17_payrolls = $request->employee['s_17_payrolls'];
            $this->s_17_perPayCost = $request->employee['s_17_perPayCost'];
            $this->s_17_employee_ppc = $request->employee['s_17_employee_ppc'];
            $this->s_18_per_pay_cost = $request->employee['s_18_per_pay_cost'];
            $this->s_18_employee_ppc = $request->employee['s_18_employee_ppc'];
            $this->s_17_census = $request->employee['s_17_census'];
            $this->s_19_per_pay_cost = $request->employee['s_19_per_pay_cost'];
            $this->s_19_employee_ppc = $request->employee['s_19_employee_ppc'];
            $this->is_company_benefit = $request->employee['is_company_benefit'];
            $this->save();

            // if( ! empty($this->is_company_benefit) && $this->is_company_benefit == 1 ) {
                foreach( $request->benefit_types as $benefirType ) {
                    foreach($benefirType['benefits'] as $order_sequence => $companyBenefit) {
                        $benefit = Benefit::find($companyBenefit['id']);
                        if( empty( $benefit ) ) {
                            $benefit = new Benefit();
                            $benefit->name = $companyBenefit['name'];
                            $benefit->benefit_type_id = $benefirType['id'];
                            $benefit->calculator = 0;

                            if( ! empty($companyBenefit['category_id']) ) {
                                $benefit->category_id = $companyBenefit['category_id'];
                            }
                            if( ! empty( $companyBenefit ) && isset( $companyBenefit['can_categorize'] ) ) {
                                $benefit->can_categorize = $companyBenefit['can_categorize'];
                            } else {
                                $benefit->can_categorize = 0;
                            }
        
                            $benefit->add_id                    = auth()->user()->id;
                            $benefit->show                      = ! empty( $companyBenefit['show'] ) ? $companyBenefit['show'] : 0;
                            $benefit->benefit_custom_name       = ! empty( $companyBenefit['additional_benefit_name'] ) ? $companyBenefit['additional_benefit_name'] : '';
                            $benefit->employer_default_value    = ! empty( $companyBenefit['employer_default_value'] ) ? $companyBenefit['employer_default_value'] : 0.00;
                            $benefit->employee_default_value    = ! empty( $companyBenefit['employee_default_value'] ) ? $companyBenefit['employee_default_value'] : 0.00;
                            $benefit->order_sequence            = ! empty( $companyBenefit['order_sequence'] ) ? $companyBenefit['order_sequence'] : $order_sequence;
                            
                            $benefit->addedby                   = $this->id;
                            $benefit->save();
                        }
    
                        if( ! empty( $benefit ) ) {
                            $pivotArgs = [
                                'add_id'                    => auth()->user()->id,
                                'show'                      => ! empty($companyBenefit['show']) ? $companyBenefit['show'] : 0,
                                'benefit_custom_name'       => ! empty($companyBenefit['additional_benefit_name']) ? $companyBenefit['additional_benefit_name'] : NULL,
                                'employer_default_value'    => ! empty($companyBenefit['employer_default_value']) ? nf($companyBenefit['employer_default_value']) : '0.00',
                                'employee_default_value'    => ! empty($companyBenefit['employee_default_value']) ? nf($companyBenefit['employee_default_value']) : '0.00',
                                'order_sequence'            => ! empty($companyBenefit['order_sequence'] ) ? $companyBenefit['order_sequence'] : $order_sequence,
                            ];
            
                            if( ! empty($companyBenefit['category_id']) ) {
                                $pivotArgs['category_id'] = $companyBenefit['category_id'];
                                $pivotArgs['can_categorize'] = 1;//$companyBenefit['can_categorize'];
                            } else {
                                $pivotArgs['category_id'] = 0;
                            }

                            if( ! empty( $companyBenefit ) && isset( $companyBenefit['can_categorize'] ) ) {
                                $pivotArgs['can_categorize'] = $companyBenefit['can_categorize'];
                            } else {
                                $pivotArgs['can_categorize'] = 1;
                            }
                            
                            // Commented becuase it was causing issue.
                            // $benefit->employees()->syncWithoutDetaching( [ $this->id => $pivotArgs ] );
                            DB::table('benefit_employee')->updateOrInsert(
                                [
                                    'benefit_id' => $benefit->id,
                                    'employee_id'=> $this->id
                                ],
                                [
                                    'add_id'                => $pivotArgs['add_id'],
                                    'benefit_custom_name'   => $pivotArgs['benefit_custom_name'],
                                    // 'benefit_id'            => $benefit->id,
                                    'can_categorize'        => $pivotArgs['can_categorize'],
                                    'category_id'           => $pivotArgs['category_id'],
                                    'employee_default_value'=> $pivotArgs['employee_default_value'],
                                    // 'employee_id'           => $this->id,
                                    'employer_default_value'=> $pivotArgs['employer_default_value'],
                                    'order_sequence'        => $pivotArgs['order_sequence'],
                                    'show'                  => $pivotArgs['show']
                                ]
                            );
                        }
                    }
                }
            // }

            return 1;
        /* } catch( \Exception $ex ) {
            dd($ex->getMessage());
        } */
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * The benefits that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function benefits( $id = false )
    {
        return $this->belongsToMany(Benefit::class, 'benefit_employee', 'benefit_id', 'employee_id');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($employee){
            DB::table('benefit_employee')->where('employee_id', $employee->id)->delete();
        });
    }

    public function delete($force_delete = 0)
    {
        $user = auth()->user();
        $get_active_plan = auth()->user()->defaultCompany()->getActivePlan();
        if( ( ! empty($user) && $user->isAdmin() ) || in_array( $get_active_plan, array('professional', 'unlimited') ) ) {
            return Parent::delete();
        } else if( ! $this->final_commited || $force_delete ) {
            return Parent::delete();
        }
        return 1;
    }

    public function markAsActive()
    {
        $this->inactive = 0;
        $this->save();
    }

    public function markAsInactive()
    {
        $this->inactive = 1;
        $this->save();
    }

    public function create( $data )
    {
        try {
            $this->company_id = auth()->user()->currentSessionCompany();
            $this->firstname = $data['firstname'];
            $this->lastname = $data['lastname'];
            $this->email = $data['email'];
            $this->phone = $data['phone'];
            $this->address_line_1 = $data['address_line_1'];
            $this->address_line_2 = $data['address_line_2'];
            $this->city = $data['city'];
            $this->state = $data['state'];
            $this->zip = $data['zip'];
            $this->group = $data['group'];
            $this->supervisor = ! empty($data['supervisor']) ? $data['supervisor'] : '';
            $this->is_digital_delivery = ! empty($data['is_digital_delivery']) ? 1 : 0;
            $this->digital_delivery_value = ! empty($data['digital_delivery_value']) ? $data['digital_delivery_value'] : 0;
            $this->mid_year_event = ! empty($data['mid_year_event']) ? $data['mid_year_event'] : '';
            $this->inactive = ! empty($data['inactive']) ? $data['inactive'] : 0;
            $this->hourly_pay_functionality = ! empty($data['hourly_pay_functionality']) ? $data['hourly_pay_functionality'] : 0;
            $this->employee_id = ! empty($data['employee_id']) ? $data['employee_id'] : '';
            $this->saved_since_added = ! empty($data['saved_since_added'])? $data['saved_since_added'] : 1;
            $this->namehash = ! empty($data['namehash'])? $data['namehash'] : '';
            $this->ssn = ! empty($data['ssn'])? $data['ssn'] : '';
            $this->s_13_job_class = ! empty($data['s_13_job_class'])? $data['s_13_job_class'] : '';
            $this->s_13_rate = ! empty($data['s_13_rate'])? $data['s_13_rate'] : '';
            $this->s_17_payrolls = ! empty($data['s_17_payrolls'])? $data['s_17_payrolls'] : '';
            $this->s_17_perPayCost = ! empty($data['s_17_perPayCost'])? $data['s_17_perPayCost'] : '';
            $this->s_17_employee_ppc = ! empty($data['s_17_employee_ppc'])? $data['s_17_employee_ppc'] : '';
            $this->s_18_per_pay_cost = ! empty($data['s_18_per_pay_cost'])? $data['s_18_per_pay_cost'] : '';
            $this->s_18_employee_ppc = ! empty($data['s_18_employee_ppc'])? $data['s_18_employee_ppc'] : '';
            $this->s_17_census = ! empty($data['s_17_census'])? $data['s_17_census'] : '';
            $this->s_19_per_pay_cost = ! empty($data['s_19_per_pay_cost'])? $data['s_19_per_pay_cost'] : '';
            $this->s_19_employee_ppc = ! empty($data['s_19_employee_ppc'])? $data['s_19_employee_ppc'] : '';
            $this->is_company_benefit = ! empty($data['is_company_benefit'])? $data['is_company_benefit'] : 0;
            $this->add_id = auth()->id();
            $this->save();
            return $this;
        } catch( Exception $ex ) {
            return $ex->getMessage();
        }
    }

    public function updateEmployeeBenefits( $data ) {
        $benefitTypes = BenefitTypes::with('benefits')->get();
        foreach( $benefitTypes as $benefitType ) {

            $order = 1;
            foreach( $benefitType->benefits as $order_sequence => $benefit ) {
                $flag = false;

                foreach( $data as $employee_id => $single ) {
                    foreach($single as $id => $sheetBenefit) {
                        
                        if( ! is_numeric($id) && is_numeric($employee_id) ) {
                            continue;
                        }
                        
                        
                        if( $benefit->id == $id ) {
                            $flag = true;
    
                            
    
                            if( ! empty( $benefit ) ) {
                                $pivotArgs = [
                                    'add_id'                    => auth()->id(),
                                    'show'                      => ! empty($sheetBenefit['show']) ? $sheetBenefit['show'] : 1,
                                    'benefit_custom_name'       => ! empty($sheetBenefit['benefit_custom_name']) ? $sheetBenefit['benefit_custom_name'] : NULL,
                                    'employer_default_value'    => ! empty($sheetBenefit['value']) ? filter_var($sheetBenefit['value'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : '0.00',
                                    'employee_default_value'    => ! empty($sheetBenefit['employee_default_value']) ? filter_var($sheetBenefit['employee_default_value'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : '0.00',
                                    'order_sequence'            => ! empty($sheetBenefit['order_sequence'] ) ? $sheetBenefit['order_sequence'] : $order,
                                    'employee_id'               => $employee_id,
                                    'benefit_id'                => $benefit->id
                                ];
                
                                if( ! empty($benefit->category_id) ) {
                                    $pivotArgs['category_id'] = $benefit->category_id;
                                    $pivotArgs['can_categorize'] = $benefit->can_categorize;
                                }
                                
                                try {
                                    /* $benefit->employees()->syncWithoutDetaching( [ $employee_id => $pivotArgs ] );

                                    DB::table('benefit_employee')->updateOrInsert(
                                        ['employee_id' => $employee_id, 'benefit_id' => $benefit->id], //the unique index to look out for
                                        $pivotArgs //the other fields to sync
                                    ); */
                                    DB::table('benefit_employee')->insert( $pivotArgs );
                                    // $rawQuery .= rawSql('benefit_employee', $pivotArgs) . ';';
                                    
                                } catch(\Exception $e) {
                                    return ["emp_id" => $employee_id, "success" => 0, "msg" => $e->getMessage(), "col" => $benefit->name];
                                    return send_error(["msg" => $e->getMessage()]);
                                }
                            }
                        }
                    }
                    
                    if( ! $flag ) {
                        
                        if( ! empty( $benefit ) ) {
                            
                            $pivotArgs = [
                                'add_id'                    => auth()->id(),
                                'show'                      => 0,
                                'benefit_custom_name'       => ! empty($benefit->benefit_custom_name) ? $benefit->benefit_custom_name : NULL,
                                'employer_default_value'    => ! empty($benefit->employer_default_value) ? filter_var($benefit->employer_default_value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : '0.00',
                                'employee_default_value'    => ! empty($benefit->employee_default_value) ? $benefit->employee_default_value : '0.00',
                                'order_sequence'            => $order,
                                'employee_id'               => $employee_id,
                                'benefit_id'                => $benefit->id
                            ];
            
                            if( ! empty($benefit->category_id) ) {
                                $pivotArgs['category_id'] = $benefit->category_id;
                                $pivotArgs['can_categorize'] = $benefit->can_categorize;
                            }
    
                            try {
                                /* $benefit->employees()->syncWithoutDetaching( [ $employee_id => $pivotArgs ] ); */
                                /* DB::table('benefit_employee')->updateOrInsert(
                                    ['employee_id' => $employee_id, 'benefit_id' => $benefit->id], //the unique index to look out for
                                    $pivotArgs //the other fields to sync
                                ); */
                                DB::table('benefit_employee')->insert( $pivotArgs );
                                // $rawQuery .= rawSql('benefit_employee', $pivotArgs) . ';';
                            } catch(\Exception $e) {
                                return ["emp_id" => $employee_id, "success" => 0, "msg" => $e->getMessage(), "col" => $benefit->name];
                                return send_error(["msg" => $e->getMessage()]);
                            }
                        }
                    }
                }
                
                $order++;
            }
        }
        // DB::unprepared($rawQuery);
        return ["emp_id" => $this->id, "success" => 1];
    }

    public function commit()
    {
        // dd($company);
        $company = auth()->user()->defaultCompany();
        $company->reduceReports(1);
        $this->final_commited = 1;
        $this->save();
    }

    public function uncommit()
    {
        $this->final_commited = 0;
        $this->save();
        $company = auth()->user()->defaultCompany();
        $company->increaseReports(1);
    }

    public function copyCompanyBenefits()
    {
        $company = auth()->user()->defaultCompany();

        $pivotData = [];
        foreach( $company->benefits as $order_sequence => $benefitT ) {
            $benefit = $benefitT->companies($company->id)->select('companies.id')->withPivot([
                'benefit_custom_name',
                'employer_default_value',
                'employee_default_value',
                'employee_co_pay',
                'show',
                'can_categorize',
                'category_id',
                'order_sequence'
            ])->first();
            
            $benefit = $benefit->pivot;
    
            $pivotData['show']                    = ! empty($benefit->show) ? true : false;
            $pivotData['benefit_custom_name']     = ! empty( $benefit->benefit_custom_name ) ? $benefit->benefit_custom_name : NULL;
            $pivotData['employer_default_value']  = ! empty( $benefit->employer_default_value ) ? $benefit->employer_default_value : '0.00';
            $pivotData['employee_default_value']  = ! empty( $benefit->employee_default_value ) ? $benefit->employee_default_value : '0.00';
            $pivotData['employee_co_pay']         = ! empty( $benefit->employee_co_pay ) ? true : false;
            $pivotData['order_sequence']          = ! empty( $benefit->order_sequence ) ? $benefit->order_sequence : $order_sequence;                    
            $pivotData["add_id"]                  = auth()->id();
        
            if( ! empty($benefit->category_id) ) {
                $pivotData['category_id'] = ! empty($benefit->category_id) ? $benefit->category_id : 0 ;
                $pivotData['can_categorize'] = ! empty($benefit->can_categorize) ? $benefit->can_categorize : 0;
            } else {
                $pivotData['category_id'] = 0;
                $pivotData['can_categorize'] = 0;
            }
    
            // SyncWithoutDetaching was not working properly.
            // $benefitT->employees()->syncWithoutDetaching( [ $this->id => $pivotData ] );
            DB::table('benefit_employee')->updateOrInsert(
                [
                    'benefit_id' => $benefitT->id,
                    'employee_id'=> $this->id
                ],
                [
                    'add_id'                => $pivotData['add_id'],
                    'benefit_custom_name'   => $pivotData['benefit_custom_name'],
                    'benefit_id'            => $benefitT->id,
                    'can_categorize'        => $pivotData['can_categorize'],
                    'category_id'           => $pivotData['category_id'],
                    'employee_default_value'=> $pivotData['employee_default_value'],
                    'employee_id'           => $this->id,
                    'employer_default_value'=> $pivotData['employer_default_value'],
                    'order_sequence'        => $pivotData['order_sequence'],
                    'show'                  => $pivotData['show']
                ]
            );
        }
    }

} 
