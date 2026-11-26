<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
// use App\Models\Company;
use App\Models\User;
use App\Models\Company;
use App\Models\Sales\Sales;
use Illuminate\Http\Request;
use App\Models\Admin\UserManager;
use App\Http\Controllers\Controller;
use App\Models\Sales\SalesTransactions;
use App\Models\Sales\SalesTransactionsStatus;

class UserManagerController extends Controller
{
    public function index()
    {
        $industries = $this->industries();
        return view('admin.usermanager.index', compact('industries'));
    }

    public function industries() {
        return (new UserManager())->industires();
    }

    public function getUsersAjax( Request $request ) {
        // $users = User::with('sales', 'sales.transactions', 'companies', 'companies.industries');
        $users = User::with(['sales' => function ($query) {
            $query->where('plan_id', '!=', 0);
        }, 'sales.transactions', 'companies', 'companies.industries']);
        
        
        if( ! empty($request->industry)  ) {
            $users = $users->whereHas( 'companies', function($query2) use ($request) {
                $query2->where('industry', '=', $request->industry);
            });
        }

        #DONE
        if( ! empty($request->from_month) && ! empty($request->from_year) && ! empty($request->to_month) && ! empty($request->to_year) ) {
            if( ! empty($request->name) ) {
                if( $request->search_by == 'user' ) {
                    $users = $users->where("name", "LIKE", '%' . $request->name .'%');
                }

                $users = $users->whereHas( 'companies', function($company) use ($request) {
                    if( $request->search_by == 'company' ) {
                        $company = $company->where("name", "LIKE", '%' . $request->name .'%');
                    }
                });
            }

            $users = $users->whereHas( 'sales', function($query2) use ($request) {
                $from = date("Y-m-d 00:00:00", strtotime($request->from_year .'-'. $request->from_month . '-01'));
                $to = date("Y-m-t 23:59:59", strtotime($request->to_year .'-'. $request->to_month . '-01'));
                $query2->whereBetween("updated_at", [$from, $to]);
                // $query2->where("plan_id", "!=", 0);
            });
        }

        if( ! empty($request->filter) ) {
            $users = $users->whereHas( 'companies', function($company) use ($request) {
                
                if( $request->filter == 'active' ) {
                    $company->where('reports_expire', ">=", date("Y-m-d H:i:s", time()));
                } else if( $request->filter == 'expired' ) {
                    $company->where('reports_expire', "<", date("Y-m-d H:i:s", time()));
                } else if( $request->filter == 'active_retailusers' ) {
                    $company->where('reports_expire', ">=", date("Y-m-d H:i:s", time()));
                } else if( $request->filter == 'expired_retailusers' ) {
                    $company->where('reports_expire', "<", date("Y-m-d H:i:s", time()));
                }/* else if( $request->filter == 'testing' ) {
                } else if( $request->filter == 'aflac' ) {
                } else if( $request->filter == 'non_aflac' ) {
                } */
            });

            if( $request->filter == 'active_retailusers' ) {
                $users = $users->where("user_role", "=", 3);
            } else if( $request->filter == 'expired_retailusers' ) {
                $users = $users->where("user_role", "=", 3);
            } else {
                $users = $users->where('user_role', '!=', 1);
            }
        }

        if( ! empty($request->orderByO) ) {
            switch( $request->orderByO['db_key'] ) {
                // Not Working
                case 'signup_date' : {
                    $users = $users->orderBy('created_at', strtoupper($request->orderByO['direction']));
                    /* $users = $users->whereHas( 'companies', function($query2) use ($request) {
                        $query2->orderBy('signup_date', strtoupper($request->orderByO['direction']));
                    }); */
                }
                break;
                // Not Working
                case 'company' : {
                    $users = $users->whereHas( 'companies', function($query2) {
                        $query2->orderBy('name', 'ASC');
                    });
                }
                break;
                // Not Working
                case 'industry' : {
                    $users = $users->whereHas( 'companies', function($query2) {
                        $query2->orderBy('industry', 'ASC');
                    });
                }
                break;


                // Working
                case 'name' : $users = $users->orderBy('name', 'ASC');
                break;
                // Working
                case 'username' : $users = $users->orderBy('username', 'ASC');
                break;
                // Working
                case 'email' : $users = $users->orderBy('email', 'ASC');
                break;
            }
        } else {
            $users = $users->orderBy('created_at', 'DESC');
        }
        
        if( ! empty($request->limit) ) {
            $users = $users->limit($request->limit)->get();
        } else {
            $users = $users->get();
        }
        
        return send_success(["users" => $users]);
    }

    public function addRemoveReports(Request $request)
    {
        $company = Company::find($request->popupUser['companies'][0]['pivot']['company_id']);

        

        $sales                      = new Sales();
        $sales->user_id             = $request->user_id;
        $sales->company_name        = $company->name;
        $sales->description         = ($request->action == 'add') ? 'Add '.$request->report_count.' report(s) at no charge' : 'Remove '.$request->report_count.' report(s) at no charge';
        $sales->plan_id             = 0;
        $sales->reports             = $request->report_count;
        $sales->signup_date         = $company->signup_date;
        $sales->reports_expires     = $company->reports_expire;
        $sales->cc_name             = '';
        $sales->cc_address          = '';
        $sales->cc_city             = '';
        $sales->cc_state            = '';
        $sales->cc_zip              = '';
        $sales->send_reminder_30    = 0;
        $sales->send_reminder_15    = 0;
        $sales->send_reminder_10    = 0;
        $sales->send_reminder_5     = 0;
        $sales->send_reminder_3     = 0;
        $sales->send_reminder_1     = 0;
        $sales->status              = 'Paid';
        $sales->add_id              = auth()->user()->id;
        $sales->created_at          = Carbon::now();
        $sales->updated_at          = Carbon::now();
        $sales->save();

        $this->createSalesTransaction([
            'transaction_id' => '[ADMIN]',
            'user_id' => $request->user_id,
            'sales_id' => $sales->id,
            'firstname' => $request->popupUser['firstname'],
            'lastname' => $request->popupUser['lastname'],
            'description' => 1,
            'reports' => $request->report_count,
            'rate' => 0,
            'amount' => 0,
            'refunded' => 0,
            'status' => 1,
            'add_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $this->updateSalesTransactionStatus([
            'user_id' => $request->user_id,
            'sales_id' => $sales->id,
            'status' => 1, // Status will change according to payment status
            'details' => 'Successful',
            'add_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        $reportspackage = $company->reportspackage;
        $reportsadditional = $company->reportsadditional;
        $reports_left = $company->reports_left;

        if( $request->action == 'add' ) {
            if( ! empty( $request->report_count ) && $request->report_count > 0 ) {
                $reportspackage += $request->report_count;
                $reportsadditional += $request->report_count;
                $reports_left += $request->report_count;
            }
            $msg = 'Reports added successfully.';
        } else if( $request->action == 'remove' ) {
            if( ! empty( $request->report_count ) && $request->report_count > 0 ) {
                $reportspackage -= $request->report_count;
                $reportsadditional -= $request->report_count;
                $reports_left -= $request->report_count;
            }
            $msg = 'Reports removed successfully.';
        }

        $company->reportspackage = $reportspackage;
        $company->reportsadditional = $reportsadditional;
        $company->reports_left = $reports_left;
        $company->save();
        
        return send_success(["msg" => $msg]);
    }

    public function createSalesTransaction( $data )
    {
        $sales_transactions = new SalesTransactions();
        $sales_transactions->transaction_id = $data['transaction_id'];
        $sales_transactions->user_id = $data['user_id'];
        $sales_transactions->sales_id = $data['sales_id'];
        $sales_transactions->firstname = $data['firstname'];
        $sales_transactions->lastname = $data['lastname'];
        $sales_transactions->description = $data['description'];
        $sales_transactions->reports = $data['reports'];
        $sales_transactions->rate = $data['rate'];
        $sales_transactions->amount = $data['amount'];
        $sales_transactions->refunded = $data['refunded'];
        $sales_transactions->status = $data['status'];
        $sales_transactions->add_id = $data['add_id'];
        $sales_transactions->created_at = $data['created_at'];
        $sales_transactions->updated_at = $data['updated_at'];
        $sales_transactions->save();
    }

    public function updateSalesTransactionStatus( $data )
    {
        $sales_transactions_status = new SalesTransactionsStatus();
        $sales_transactions_status->user_id = $data['user_id'];
        $sales_transactions_status->sales_id = $data['sales_id'];
        $sales_transactions_status->status = $data['status'];
        $sales_transactions_status->details = $data['details'];
        $sales_transactions_status->add_id = $data['add_id'];
        $sales_transactions_status->created_at = $data['created_at'];
        $sales_transactions_status->updated_at = $data['updated_at'];
        $sales_transactions_status->save();
    }
}
