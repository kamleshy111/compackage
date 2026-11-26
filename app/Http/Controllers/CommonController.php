<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\SystemItems;
use App\Models\UserRolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CommonController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/** 
	 * If user has access to the current route? 
	 * Params: $user_id (optional)
	 * Returns: False for access denied and current route on success.
	 * */
	public static function ifUserHasAccess($user_id = '')
	{
		$user = '';
		if( ! empty($user_id) ) {
			$user = User::find($user_id);
		} else {
			$user = Auth::User();
		}

		// if( ! empty($user) && $user->isAdmin() ) {
		// 	return;
		// }

		// Get error codes
		$error_codes = config("constants.error_codes");
		
		// Checking user
		if ( ! empty($user) ) {
			// Checking user role
			if( ! empty($user->user_role) ) {
				/* User status must be 1 to login (except 1 means user is not active for now).*/
				if( $user->status == 1 ) {
					$current_url = url()->current();
					$appurl = env('APP_URL');
					$route = str_replace($appurl, "", $current_url);
					$route = Route::current()->uri;
					
					// Get Route data from DB
					$route_data = SystemItems::select("id", "section_of", "section_uri", "related_model", "action_type", "section_is_active")
					->where('section_is_active', "=", 1)
					->where('section_uri', "like", $route)
					->first();
					
					// If route data exists then, fetch the permissions else throw error with code.
					if (!empty($route_data)) {
						$route_id = $route_data->id;
						$permission = UserRolePermission::where('user_role_id', $user->user_role)
						->where("section_id", '=', $route_id)->where("permission", 1);
						
						$company_session = request()->session()->get('user_permissions');
						if( ! empty($company_session['user_type']) ) {
							$permission = $permission->where('company_role', $company_session['user_type']);
						}

						$permission = $permission->first();
						// If user have permission then, allow the user and create a session with route permission else throw error with code
						if ( ! empty($permission)) {
							// Check route permission action_type and create session.
							if( ! empty($route_data->action_type) && $permission->{$route_data->action_type} ) {
								
								$route_permissions = [
									'view'					=> $permission->view,
									'create'				=> $permission->create,
									'update'				=> $permission->update,
									'delete'				=> $permission->delete,
									"section_of"			=> $route_data->section_of,
									'action_type'			=> $route_data->action_type,
									"related_model"			=> $route_data->related_model,
									'custom_permissions'	=> $permission->custom_permissions,
									'company_role'			=> $permission->company_role,
								];
								request()->session()->put('route_permissions', $route_permissions);
		
								return ['code' => 1, "resp" => "You are allowed"];
							}
							return ['code' => 7, "resp" => $error_codes[7]];
						}
						return ["code" => 6, "resp" => $error_codes[6]];
					}
					return ["code" => 5, "resp" => $error_codes[5]];
				}
				return ['code' => 4, "resp" => $error_codes[4]];
			}
			return ['code' => 3, "resp" => $error_codes[3]];
		}
		return [ 'code' => 0, 'resp' => $error_codes[0] ];
	}

	public static function getPermissionForPolicies( $user_id = false, $action_type = false)
	{
		if( empty($user_id) || empty($action_type) ) {
			return false;
		}

		$route_permissions = request()->session()->get('route_permissions');
		if( empty( $route_permissions ) && empty($route_permissions[$action_type]) ) {
			$route_permissions = CommonController::ifUserHasAccess($user_id);
		}
		if( ! empty($route_permissions) && ! empty($route_permissions[$action_type]) && $route_permissions[$action_type] == 1)
		{
			return true;
		}
		return false;
	}

	/**
	 * 
	 */
	public static function getUpdateCompanySession($company_id = false)
	{
		$user = auth()->user();

        $reportCount = $user->reportCount();
		//dd($reportCount);
		if (!empty($company_id)) {

			$user_company = $user->companies()
				->where("company_id", $company_id)
				->where("companies.status", 1)
				// ->where("users.status", 1)
				->where("company_user.status", 1)
				->withPivot('permission_type')
				->first();

			if (!empty($user_company)) {
				$user_permissions = [
					"current_user_company_id" => $company_id,
					"user_type" => $user->getCompanyPermission($company_id),
                    "reports" => $reportCount,
					"is_reports_expired" => $user_company->canCompanyPrintReports()
				];
				update_user_meta($user->id, 'current_user_company_id', $company_id);
				request()->session()->put('user_permissions', $user_permissions);

				return array("access_code" => 1, "message" => "Company successfully switched");
			}
			return array("access_code" => 0, "message" => "Company relation does not exist.");
		}

		$user_permissions = [];
		
		/**
		 * Get all active companies of the logged in user.
		 * The company must be active and the user should have active access to this company.
		 **/
		$user_companies_obj = $user->companies()->where("company_user.status", 1)->where("companies.status", 1);
		$user_companies = $user_companies_obj->get();

		if (empty($user_companies_obj) || $user_companies->isEmpty()) {
			abort(403, 'Something went wrong with your submission. Please contact support.');
			$user_permissions = ["current_user_company_id" => '',"user_type" => ''];
		}
		else
		{
			// Get user permission from the session.
			$company_session = request()->session()->get('user_permissions');
			// dd($company_session);
			// If session does not exists then, create session and save default company in the meta
			if (empty($company_session) || empty($company_session["current_user_company_id"]) || empty($company_session["user_type"]) ) {
				$current_user_company_id = get_user_meta($user->id, 'current_user_company_id');
				
				// If user already have a default company then create session. else set first active company as default company.
				if (!empty($current_user_company_id)) {
					$user_company = Company::findOrFail($current_user_company_id);
					$user_permission_type = $user->getCompanyPermission($current_user_company_id);
					// User should have admin or user access. If user have null then the user doesn't have access.
					if (!empty($user_permission_type) && in_array($user_permission_type, array('admin', 'user'))) {
						$user_permissions = [
							"current_user_company_id" => $current_user_company_id,
							"user_type" => $user_permission_type,
                            "reports" => $reportCount,
							"is_reports_expired" => $user_company->canCompanyPrintReports()
						];
						/*request()->session()->put('user_permissions', $user_permissions);
						return array("access_code" => 1, "message" => "The user have access to the company.");
						*/
					} else {
						$user_permissions = ["current_user_company_id" => '',"user_type" => ''];
						/*request()->session()->put('user_permissions', $user_permissions);
						return array("access_code" => 0, "message" => "The user doesn't have access to the selected company. Please select another company.");*/
					}
				} else {
					$user_company = $user_companies_obj->first();
					update_user_meta($user->id, 'current_user_company_id', $user_company->id);
					$user_permission_type = $user->getCompanyPermission($current_user_company_id);
					// User should have admin or user access. If user have null then the user doesn't have access.
					if (!empty($user_permission_type) && in_array($user_permission_type, array('admin', 'user'))) {
						$user_permissions = [
							"current_user_company_id" => $current_user_company_id,
							"user_type" => $user_permission_type,
                            "reports" => $reportCount,
							"is_reports_expired" => $user_company->canCompanyPrintReports()
						];
						/*request()->session()->put('user_permissions', $user_permissions);
						return array("access_code" => 1, "message" => "The user have access to the company.");*/
					} else {
						$user_permissions = ["current_user_company_id" => '',"user_type" => ''];
						/*request()->session()->put('user_permissions', $user_permissions);
						return array("access_code" => 0, "message" => "The user doesn't have access to the selected company. Please select another company.");*/
					}
				}
			} else {
				$current_user_company_id = $company_session['current_user_company_id'];
				// If user already have a default company then create session. else set first active company as default company.
				if (!empty($current_user_company_id)) {
					$user_permission_type = $user->getCompanyPermission($current_user_company_id);
					$user_company = Company::findOrFail($current_user_company_id);

					// User should have admin or user access. If user have null then the user doesn't have access.
					if (!empty($user_permission_type) && in_array($user_permission_type, array('admin', 'user'))) {
						$user_permissions = [
							"current_user_company_id" => $current_user_company_id,
							"user_type" => $user_permission_type,
                            "reports" => $reportCount,
							"is_reports_expired" => $user_company->canCompanyPrintReports()
						];
	
						/*request()->session()->put('user_permissions', $user_permissions);
						return array("access_code" => 1, "message" => "The user have access to the company.");*/
					} else {
						$user_permissions = ["current_user_company_id" => '',"user_type" => ''];
						/*request()->session()->put('user_permissions', $user_permissions);
						return array("access_code" => 0, "message" => "The user doesn't have access to the selected company. Please select another company.");*/
					}
				}
				else
				{
					$user_permissions = ["current_user_company_id" => '',"user_type" => ''];
				}
			}
		}
		request()->session()->put('user_permissions', $user_permissions);
	}
}
