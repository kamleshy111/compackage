<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;

class IfValidUserRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(Auth::check())
		{
            $user = auth()->user();
            $appurl = env('APP_URL');
            $current_url = url()->current();
            $route = str_replace($appurl, "", $current_url);

            
            /**
             * Check user if isAdmin or isAdmin URL
             */
            if( ! empty($user) && $user->isAdmin() && ! in_array("webapp", explode("/",$route)) ) {
                return $next($request);
            } else if( ! empty($user) && $user->isAdmin() && $request->wantsJson() ) {
                return $next($request);
            }
            
            
            /* Create session for the companies and their permissions. */
            CommonController::getUpdateCompanySession();
            // dd($user);
            /**
             * Checking route permissions in middleware instead of checking in web.php
             * It will make the code centerlized at one place(Writing code at one place instead of different locations. :simple_smile: )
             */
            
            $route_permissions = CommonController::ifUserHasAccess();
            if ( empty($route_permissions['code']) || $route_permissions['code'] != 1 ) {
                abort(403, $route_permissions['resp']);
            }

			/* Create session for the companies and their permissions. */
            //CommonController::getUpdateCompanySession();
            return $next($request);

            /*$permission_type = CommonController::getUpdateCompanySession();*/
            /**
             * 1 = have access to the company
             * 0 = don't have access
             */
            /*if( ! empty($permission_type['access_code']) && $permission_type['access_code'] != 1 ) {
                // Redirect was not working so, for now redirect using js 
                // return redirect('/accessdenied'); 
                echo '<script type="text/javascript"> location.href = "'.route('accessdenied').'"</script>';
            }
            return $next($request);*/
		}
		return redirect('login');
    }
}
