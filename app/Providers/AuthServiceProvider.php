<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Webapp\Company;
use App\Policies\BenefitPolicy;
use App\Policies\CompanyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Company::class => CompanyPolicy::class,
        Benefit::class => BenefitPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        /**
         * Define custom gate for the application by SS
         */
       	Gate::resource('user', UserPolicy::class);
        Gate::resource('company', CompanyPolicy::class);
        Gate::resource('benefit', BenefitPolicy::class);
        Gate::resource('insuranceprogramtype', InsuranceProgramTypePolicy::class);
        
    }
}
