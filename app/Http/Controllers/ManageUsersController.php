<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendUserInformationMail;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\CompanyController;
use Illuminate\{Support\Facades\Hash, Support\Facades\Validator, Http\Request};

class ManageUsersController extends Controller
{
    public function __construct()
    {
        $this->companyController = new CompanyController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $company = auth()->user()->defaultCompany();
        if( $company->parent_company_id == 0 ) {
            $company_id = $company->id; // replace with the actual company ID
            $company_owner = $company->company_owner;


            // $users = DB::table('users as u')
            //         ->select(DB::raw('DISTINCT u.id, u.username, u.email, u.firstname, u.lastname, u.status, u.created_at, CONCAT(u.lastname, ", ", u.firstname) AS fullname'))
            //         ->leftJoin('company_user as cu', 'cu.user_id', '=', 'u.id')
            //         ->where(function ($query) use ($company_id) {
            //             $query->whereIn('cu.company_id', function ($subquery) use ($company_id) {
            //                     $subquery->select('id')->from('companies')->where('id', '=', $company_id)->orWhere('parent_company_id', '=', $company_id);
            //             });
            //         })
            //         ->orderBy('lastname')->orderBy('firstname')->get();
                    // if( ! empty( $_GET['test'] ) ) {
                        $companies = DB::table('companies')->select('id')->where('id', $company_id)->orWhere('parent_company_id', '=', $company_id)->pluck('id')->toArray();
                        $users = DB::table('company_user')->whereIn('company_id', $companies)->distinct('user_id')->pluck('user_id')->toArray();
                        // dd($users);
                    // }
        } else {
            // dd($company->id);
            $company_id_default = $company->id;
            $company = Company::find($company->parent_company_id);
            $company_id = $company->id;
            $company_owner = $company->company_owner;
            
            // $users = DB::table('users as u')
            //         ->select(DB::raw('DISTINCT u.id, u.username, u.email, u.firstname, u.lastname, u.status, u.created_at, CONCAT(u.lastname, ", ", u.firstname) AS fullname'))
            //         ->leftJoin('company_user as cu', 'cu.user_id', '=', 'u.id')
            //         ->where('cu.company_id', '=', $company_id)
            //         ->orderBy('lastname')->orderBy('firstname')->get();

            // if( ! empty( $_GET['test'] ) ) {
                // $companies = DB::table('companies')->select('id')->where('id', $company_id)->pluck('id')->toArray();
                
                $users = DB::table('company_user')->where('company_id', $company_id_default)->distinct('user_id')->pluck('user_id')->toArray();
                
            // }
            
        }

        $users = DB::table('users as u')
        ->select(DB::raw('u.id, u.username, u.email, u.firstname, u.lastname, u.status, u.created_at, CONCAT(u.lastname, ", ", u.firstname) AS fullname'))
        ->whereIn('u.id', $users)->orderBy('lastname')->orderBy('firstname')->get();
        // dd($users);
        /* $users = Company::where('id',$company->id)->with(['users' => function ($query) {
            $query->distinct('user_id');
        }])->first()->users; */

        $companies = auth()->user()->companies()->select("companies.id", "companies.name", "companies.status", "companies.reportspackage")->where('companies.status', 1)->get()->toArray();

        $user_permissions = session()->get('user_permissions');
        $reports_count = $user_permissions['reports'];

        return view('webapp.user.index', compact('users', 'companies', 'reports_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->companyController->getCompaniesByUserAPI(auth()->user()->id);
        return view('webapp.user.create', compact('companies'));
    }

    /**
     * Create user API
     */
    public function createAPI(Request $request)
    {
        $validator = Validator::make($request->all(), [
        // $this->validate($request, [
            'firstname' => "required|String",
            'lastname'  => "required|String",
            'email'     => "required|email",
            'username'  => "required|String",
            //'permission_type' => "required",
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

        if ( empty($request->get('companies')) ) {
            return send_error(["msg" => "Please select a company."]);
        }

        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) 
        {
            // Email already exists, handle accordingly (perhaps show an error message)
            return send_error(["msg" => "Email already exists."]);
        }
        
        $send_password_reset_link = false;
        if( $request->get('id') > 0 ) {
            $user = User::findOrFail($request->get('id'));
            
            if( $request->get('id') == auth()->id() ) {
                // Show error message if required
                /*
                if( $request->permission_type == 'user' ) {
                    $request->permission_type = 'admin';
                    return send_error(["msg" => "You cannot set your permission to 'User'."]);
                }
                */
                if( ! $request->status ) {
                    //$request->permission_type = 'admin';
                    return send_error(["msg" => "You cannot set your status to 'Inactive'."]);
                }
            } else {
                $user->status = ! empty($request->status) ? 1 : 0;
            }
        } else {
            $user = new User();
            $send_password_reset_link = true;
            $user->status = !empty($request->status) ? 1 : 0;
        }

        $user->name = $request->firstname . ' ' . $request->lastname;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->user_role = 3;
        //$user->permission_type = 'user';
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        
        $user->password = Hash::make(Str::random(10));
        $user->save();

        if( $send_password_reset_link ) {
            //Password::sendResetLink(['email' => $request->email]);

            $company_id = auth()->user()->currentSessionCompany();
            if( ! empty($company = Company::find($company_id))) {
                $user->parent_id = $company->company_owner;
            } else {
                $user->parent_id = auth()->user()->id;
            }
           
            $user->save();
        }

        $syncData = [];
        
        foreach( $request->get('companies') as $company_id ) {
            $syncData[$company_id] = ['add_id' => auth()->user()->id, 'permission_type' => 'admin', 'status' => !empty($request->status) ? 1 : 0];
            //$syncData[$company_id] = ['add_id' => auth()->user()->id,'status' => !empty($request->status) ? 1 : 0];
        }
        
        $user->companies()->sync($syncData);
        if( ! empty($request->get('id')) ) {
            return send_success(["msg" => "User updated"]);
        } else {
            return send_success(["msg" => "User created"]);
        }
    }

    /**
     * Get user by ID with their companies
     */
    public function getUserByIdAPI($id)
    {
        $user = User::select("id", "name", "firstname", "lastname", "username", "user_role", "parent_id", "email", "status")->with(['companies' => function ($query) {
            $query->select('companies.id', 'companies.name', 'company_user.permission_type', 'company_user.status');
        }])->findOrFail($id);
        
        if ( ! empty($user) ) {
            if( $user->companies->count() > 0 ) {
                $selected_companies = [];
                //$user->permission_type = $user->companies[0]->permission_type;
                foreach( $user->companies as $i => $company  ) {
                    $user->companies[$i] = $company->id;
                    $selected_companies[$company->id] = $company;
                }
                $user->selected_companies = $selected_companies;
            }

            return send_success($user->toArray());
        }
        return send_error(["msg" => 'Unable to fetch the user.']);
    }

    public function userWithCompanies(Request $request)
    {
        dd($request->all());
    }

    public static function createOrUpdateUserOnPlanPurchase( $user_data )
    {
        /* If a user already exists in the database then, do not create new user simply login the user and update the user. */
        $new_user = User::where('email', $user_data['email'])->first();
        if( empty($new_user) || $new_user == null ) {
            $new_user = new User();
            $new_user->password = Hash::make($user_data['password']);
        } else {
            Auth::login($new_user);
        }
        
        $new_user->firstname    = $user_data['firstname'];
        $new_user->lastname     = $user_data['lastname'];
        $new_user->name         = $user_data['firstname'] . ' ' . $user_data['lastname'];
        $new_user->email        = $user_data['email'];
        $new_user->user_role    = $user_data['user_role'];
        $new_user->username     = $user_data['username'];
        $new_user->status       = $user_data['status'];
        
        $new_user->save();

        if( $new_user ) {
            Auth::login($new_user);
            return $new_user->id;
        }
        return null;
    }

    // Account Information
    public function accountInformation()
    {
        $company = auth()->user()->defaultCompany();
        $companies = auth()->user()->defaultCompanygetall();
        $employee = auth()->user()->employeesgetall();
        return view('webapp.user.account-information', compact('company', 'companies', 'employee'));
    }

    public function resetPassword( Request $request )
    {
        if( ! empty($request->id) && $user = User::find($request->id) ) {
            if( $request->action == 'resetpassword' ) {
                $user->resetPassword();
                return send_success(["msg" => "Password reset mail sent!!"]);
            } else if( $request->action == 'senduserinformation' ) {
                Mail::to($user->email)->send(new sendUserInformationMail($user));
                $user->resetPassword();
                // Below email should be sent as per the template code. Right now this PW reset link was not working so temporary updated this.
                return send_success(["msg" => "User information mail sent!!"]);
            } else if( $request->action == 'deleteuser' ) {
                $user->delete();
                return send_success(["msg" => "User deleted successfully!!"]);
            }
        }
        return send_error(["msg" => 'Please select a user.']);
    }

    public function destroy($id)
    {
        if( ! empty( auth()->user() ) && auth()->id() == $id ) {
            return send_error(["msg" => "You cannot delete yourself."]);
        }

        if( ! empty($id) && $user = User::find($id) ) {
            try {
                $user = User::find($id);
                $is_deleted = $user->delete(); // Delete will check for permission in the model.

                if( ! is_error( $is_deleted ) ) {
                    return send_success(["msg" => "User deleted successfully."]);
                } else {
                    return send_error(["msg" => "Something went wrong."]);            
                }
            } catch( Exception $ex ) {
                return send_error(["msg" => $ex->getMessage()]);
            }
        }
        return send_error(["msg" => "User not found."]);
    }

}
