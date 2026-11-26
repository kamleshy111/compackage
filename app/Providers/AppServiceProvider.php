<?php

namespace App\Providers;

use Laravel\Cashier\Cashier;
use App\Http\Controllers\CommonController;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    /*
    public function register()
    {
        Cashier::ignoreMigrations();
    }
    */
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Sharing some default variables globally to all the views
         */
        view()->composer('*', function ($view) 
        {
            $companies = [];
            if( auth()->user() ) {
                $companies = auth()->user()->companies()->where('company_user.status', 1)->get();
                $view->with('logged_user_companies', $companies );
            }
        }); 
    }
}
