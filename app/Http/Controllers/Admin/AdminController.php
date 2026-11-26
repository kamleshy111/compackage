<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the home page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function getUserDetails(Request $request)
    {
        if( ! empty($request->user_id) && $user = User::find($request->user_id) ) {
            $user = User::where('id', $request->user_id)
                        ->with([
                            'sales',
                            'sales.plans',
                            'sales.transactions' => function($transaction) {
                                $transaction->select('sales_id', 'refunded', 'transaction_id', 'description', 'amount');
                            },
                            'sales.transactionsStatus',
                            'companies' => function($company) {
                                $company->select(
                                    'name',
                                    'telephone',
                                    'phone_ext',
                                    'industry',
                                    'reports_left',
                                    DB::raw('reportspackage - reports_left AS reportsprocessed'),
                                    'reportsadditional',
                                    'signup_date',
                                    'aflac',
                                    'reports_expire',
                                    'parent_company_id'
                                )->where('parent_company_id', 0)->orderBy('signup_date', 'desc');
                            }
                        ])->first()->toArray();
            
            return send_success(["user" => $user]);
        }
        return send_error(["msg" => 'User is not vaild']);
    }

    public function switchUser(Request $request) {
        $user = User::find($request->user_id);
        if( empty($request->user_id) || ! $user) {
            abort(404);
        }

        $user = auth()->user();
        Auth::logout(); 

        $user = User::find($request->user_id);
        Auth::login($user);
        return redirect('/login/');
    }
    
}
