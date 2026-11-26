<?php

namespace App\Models;

use App\Models\User;
use App\Models\Benefit;
use App\Models\BenefitTypes;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MediaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $appends = ['total_reports'];

    public function getTotalReportsAttribute() // notice that the attribute name is in CamelCase.
    {
        return ($this->reportspackage); // + $this->reportsadditional
    }

    /**
     * The users that belong to the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user', 'company_id', 'user_id');
    }

    /**
     * The benefits that belong to the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function benefits()
    {
        return $this->belongsToMany(Benefit::class, 'company_benefit', 'company_id', 'benefit_id'); // ->orderBy('benefit_type_id', 'ASC')
    }

    /**
     * The employees that belong to the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get all of the sales for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industries()
    {
        return $this->hasOne(Industry::class, 'id', 'industry');
    }

    /**
     * The employees that belong to the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getAttachment()
    {
        return MediaController::getAttachment($this->logo);
    }

    public function reduceReports( $employee_count )
    {
        $this->reports_left = ($this->reports_left - 1);
        // $this->reports_left = ($this->total_reports - 1);
        if( $this->total_reports < 10000 ) {
            $this->save();
        }
    }
    
    public function increaseReports( $employee_count )
    {
        $this->reports_left = ($this->reports_left + 1);
        // $this->reports_left = ($this->total_reports + 1);
        if( $this->total_reports < 10000 ) {
            $this->save();
        }
    }

    public function canCompanyPrintReports()
    {
        $time_diff = (strtotime($this->reports_expire) - time());

        if( $time_diff > 0 ) {
            return true;
        }

        return false;
    }

    /**
     * Save global benefits to company beneftis
     */
    public function copyGlobalBenefits()
    {
        $benefitTypes = BenefitTypes::with('benefits')->get();

        /** Loop through the benefit type and benefits to save. */
        foreach( $benefitTypes as $benefirType ) {
            foreach( $benefirType->benefits as $order_sequence => $benefit ) {

                /** Pivot data for the company. */
                $pivotArgs = [
                    'add_id'                    => auth()->user()->id,
                    'show'                      => ! empty( $benefit->show ) ? 1 : 0 ,
                    'benefit_custom_name'       => ! empty( $benefit->additional_benefit_name ) ? $benefit->additional_benefit_name : '' ,
                    'employee_co_pay'           => ! empty( $benefit->employee_co_pay ) ? true : false ,
                    'employer_default_value'    => ! empty( $benefit->employer_default_value ) ? $benefit->employer_default_value : 0.00 ,
                    'employee_default_value'    => ! empty( $benefit->employee_default_value ) ? $benefit->employee_default_value : 0.00,
                    'addedby'                   => ! empty( $benefit->addedby ) ? $benefit->addedby : '',
                    'order_sequence'            => ! empty( $benefit->order_sequence ) ? $benefit->order_sequence : $order_sequence
                ];

                // Add catagories list if exists
                if( ! empty($benefit->category_id) ) {
                    $pivotArgs['category_id'] = $benefit->category_id;
                    $pivotArgs['can_categorize'] = $benefit->can_categorize;
                }
                // Saving data to company_benefit table.
                $benefit->companies()->syncWithoutDetaching( [ $this->id => $pivotArgs ] );
            }
        }
    }

    /**
     * Get current active plan of the company
     */
    public function getActivePlan() {
        if( $this->is_reseller && $this->reportspackage >= 10000 ) {
            return 'professional';
        } else if( ! $this->is_reseller && $this->reportspackage >= 10000 ) {
            return 'unlimited';
        } else if( ! $this->is_reseller && $this->reportspackage < 10000 ) {
            return 'standard';
        }
        return false;
    }

        /**
     * Get report remaining report count of the company reports including multiple plans
     */
    public function getRemainingReportsCount() {
        $company = auth()->user()->defaultCompany();

        $totalReports = 0;
        $totalRemaining = 0;
        // $employeeCount = $company->employees->count();
        $companies = auth()->user()->defaultCompanygetall();
        $employeeCommitedCount = $company->employees->where('final_commited', 1)->count();
        // dd($company->employees->where('final_commited', 0));
        // $employeeUncommitedCount = $company->employees->where('final_commited', 0)->count();
        foreach ($companies as $companyreport) {
            
            $today = now();
            if($companyreport->reports_expires > $today)
            {
                $totalRemaining += $companyreport->reports;
            }
            //$totalReports += $companyreport->reports;
            /*
            if($companyreport->signup_date->diffInDays($companyreport->reports_expires, false) > 0) {
                $totalRemaining += $companyreport->reports;
            }
            $totalReports += $companyreport->reports;
            */
        }
        //return $totalReports;
        return $totalRemaining - $employeeCommitedCount;
        
    }

    /**
     * Get report remaining report count of the company reports including multiple plans
     */
    public function youCanLoadUpto() {
        $company = auth()->user()->defaultCompany();

        $totalReports = 0;
        $totalRemaining = 0;
        // $employeeCount = $company->employees->count();
        $companies = auth()->user()->defaultCompanygetall();
        $employeeCommitedCount = $company->employees->where('final_commited', 1)->count();
        // dd($company->employees->where('final_commited', 0));
        $employeeUncommitedCount = $company->employees->where('final_commited', 0)->count();
        
        foreach ($companies as $companyreport) {
            if($companyreport->signup_date->diffInDays($companyreport->reports_expires, false) > 0) {
                $totalRemaining += $companyreport->reports;
            }
            $totalReports += $companyreport->reports;
        }
        // dd($totalReports, $employeeUncommitedCount);
        return $totalReports - ($employeeCommitedCount + $employeeUncommitedCount);
    }
}
