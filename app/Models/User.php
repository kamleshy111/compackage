<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use App\Models\{Company, UserMeta, Sales\Sales};
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\{ Database\Eloquent\Factories\HasFactory, Foundation\Auth\User as Authenticatable, Notifications\Notifiable, Contracts\Auth\MustVerifyEmail};

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        "username",
        'password',
        'user_role',
        "parent_id",
        "status",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $appends = ['last_login', 'parent_user'];

    /**
     * Return last login of the user.
     * @return lastlogin
     */
    public function getLastLoginAttribute() {
        if( ! empty( $lastLogin = $this->loginLogs()->latest()->first() ) ) {
            return date("d/m/Y H:i:s A", strtotime($lastLogin->created_at));
        }
        return null;
    }
    
    /**
     * Return last login of the user.
     * @return lastlogin
     */
    public function getParentUserAttribute() {
        if( ! empty($this->parent_id) && $this->parent_id > 0 ) {
            if( $p_user = User::find($this->parent_id) ) {
                return $p_user->name;
            }
        }
        return null;
    }

    /**
     * Get all of the loginLogs for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loginLogs(): HasMany
    {
        return $this->hasMany(LoginLog::class);
    }

    /**
     * Check permissions before deleting the user and their relationships
     * 
     * @return boolean on success and error on failer
     */
    public function delete()
    {
        if( request()->session()->get('user_permissions')['user_type'] == 'admin' ) {
            try {
                Parent::delete();
                return true;
            } catch( Exception $ex ) {
                return error(500, $ex->getMessage());
            }
        } else {
            return error(500, "You are not authorized for this delete operation.");
        }
        return true;
    }
    
    /**
     * Admin
     */
    public function isAdmin()
    {
        return ($this->user_role == 1);
    }

    /**
     * Reseller
     */
    public function isReseller()
    {
        return ($this->user_role == 2);
    }

    /**
     * Company User
     */
    public function isUser()
    {
        return ($this->user_role == 3);
    }

    /**
     * Get user by
     */
    public function getUserBy( $field = 'email', $email ) {
        $this->where($field, $email)->first();
    }

    /**
     * The companies that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_user', 'user_id', 'company_id');
    }

    /**
     * Getting all the childrens of the parent user.
     */
    public function children()
    {  
        return $this->where('parent_id', $this->id)->get();
    }

    /**
     * Get the metas that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function metas()
    {
        return $this->hasMany(UserMeta::class);
    }

    public function defaultCompany()
    {
        // $this->currentSessionCompany();
        $company = Company::find($this->currentSessionCompany());
        return $company;
    }

    /** New code update*/
    public function defaultCompanygetall()
    {
        $company = Company::where('id', $this->currentSessionCompany())->first();
        $sale = Sales::where('user_id',$company->company_owner)->get();
        return $sale;
    }

    /** New code update */
    public function employeesgetall()
    {
        $company = Company::where('id', $this->currentSessionCompany())->first();
        $employeeCount = Employee::where('company_id', $company->id)->where('final_commited', 1)->where('inactive', 0)->count();
        return $employeeCount;
    }

    public function defaultCompanyLicencePackage()
    {
        $this->currentSessionCompany();
        $company = Company::where('id', $this->currentSessionCompany())->select('id', DB::raw('(YEAR(reports_expire) - YEAR(signup_date)) as year'))->pluck('year');
         //dd($company);
        if( $company->first() >= 4 ) {
            return 4;
        }
        return $company->first();
    }

    public function isResubscribed() {
        $company = Company::where('id', $this->currentSessionCompany())->first();
        //$sale = Sales::where('user_id',$company->company_owner)->first();
        $sale = Sales::where('user_id', $company->company_owner)->orderByDesc('signup_date')->first();
        if( ! empty($sale) && $sale->resubscribed ) {
            return 1;
        }
        return 0;
    }

    public function canCreateEmployee()
    {
        $company = $this->defaultCompany();
        //$employeeCount = $company->employees->count();
        $employeeCount = $company->employees->where('final_commited', 1)->count();

        # Newly added after doing code for multiple plans purchase
        $companies = auth()->user()->defaultCompanygetall();
        $totalReports = 0;
        $totalRemaining = 0;
        
        foreach ($companies as $companyreport) {
            if($companyreport->signup_date->diffInDays($companyreport->reports_expires, false) > 0) {
                $totalRemaining += $companyreport->reports;
            }
            $totalReports += $companyreport->reports;
        }
        # END
        //dd($employeeCount);
        // if( $company->total_reports > $employeeCount || $company->total_reports >= 10000) {
        if( $totalReports > $employeeCount || $totalReports >= 10000) {
            return true;
        } else {
            return false;
        }
    }
    
    public function defaultCompanyEmployees($committed = 'all')
    {
        $company = $this->defaultCompany();
        if( $committed == 'all' ) {
            return $company->employees;
        } else if( $committed == 'yes' ) {
            return $company->employees->where('final_commited', 1);
        } else if( $committed == 'no' ) {
            return $company->employees->where('final_commited', 0);
        } else if(  $committed == 'acitve'  ) {
            return $company->employees->where('inactive', 0);
        } else if(  $committed == 'inactive'  ) {
            return $company->employees->where('inactive', 1);
        }
    }

    /**
     * Get the metas that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currentSessionCompany()
    {
        $current_session_company = 0;

        if( ! empty( request()->session()->get('user_permissions') ) ) {
            $current_session_company = request()->session()->get('user_permissions')['current_user_company_id'];
        }

        if( ! empty( $current_session_company ) && $current_session_company > 0 ) {
             return $current_session_company;
        } else if( $current_session_company = $this->hasMany(UserMeta::class)->where('meta_key', 'current_user_company_id')->first() ) {
            return $current_session_company = $current_session_company->meta_value;
        }
        return $current_session_company;
    }

    public function defaultCompanyAddress()
    {
        $company_id = $this->currentSessionCompany();
        if( ! empty( $company_id ) ) {
            $company = Company::select('addr1', 'addr2', 'city', 'state', 'telephone', 'zip')->find($company_id);
            return $company;
        }
        return null;
    }

    /**
     * Get user permission based on company.
     */
    public function getCompanyPermission($company_id = false )
    {
        $temp = $this->belongsToMany(Company::class)->where('company_user.company_id', $company_id)->withPivot('permission_type')->first();
        if( ! empty( $temp ) ) {
            return $temp->pivot->permission_type;
        }
    }

    /**
     * Get all of the sales for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(Sales::class, 'user_id', 'id');
    }

    /* public function companies()
    {
        return $this->hasMany(Sales::class, 'user_id', 'id');
    } */

    public function reportCount()
    {
        //NEEDTOCHECK:
        /* $plans = Sales::where('user_id', auth()->id())->get();
        $reportCount = 0;
        
        foreach( $plans as $plan ) {
            if( $plan->reports == -1 ) {
                $reportCount = 'unlimited';
            } else if( $reportCount != 'unlimited' ) {
                $reportCount += $plan->reports;
            }
        } */
        /*
        $plans = Sales::where('user_id', auth()->id())->get();
        $plan_id = null;
        
        foreach ($plans as $plan) {
            if (!empty($plan->plan_id)) {
                $plan_id = $plan->plan_id;
                break;
            }
        }
        
        $totalReports = '';
        $reportCount = 0;
        
        if (!is_null($plan_id)) {
            $membershipPlan = MembershipPlans::find($plan_id);
            
            if (!is_null($membershipPlan)) {
                $totalReports = $membershipPlan->allowed_reports;
                $reportCount = $totalReports;
            }
        }
        */
        $company = $this->defaultCompany();
        $reportCount = 0;
        if( ! empty( $company ) ) {
            $reportCount = $company->reports_left;
        }
        
        return $reportCount;
    }

    function totalReportCount() {
        $company = $this->defaultCompany();
        $totalReportCount = 0;
        if( ! empty( $company ) ) {
            $totalReportCount = $company->total_reports;
        }
        return $totalReportCount;
    }

    public function resetPassword()
    {
        Password::sendResetLink(["email" => $this->email]);
    }

    public function getResetPasswordLink()
    {
        $user = DB::table('users')->where('email', '=', $this->email)->first();
        
        //Check if the user exists
        if (empty($user)) {
            return 2;
        }

        $token = $this->createResetPasswordToken($this->email);

        if( ! empty( $token ) ) {
            $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($this->email);
            return $link;
        } else {
            return 3;
        }
    }

    private function createResetPasswordToken( $email )
    {
        try{
            $raw_token = Str::random(60);
            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $raw_token,
                'created_at' => Carbon::now()
            ]);

            //Get the token just created above
            $tokenData = DB::table('password_resets')->where('email', $email)->first();

            return $raw_token;
        } catch( Exception $ex ) {
            return '';
        }
    }
}
