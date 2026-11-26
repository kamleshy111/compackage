<?php

namespace App\Http\Controllers\Admin;

use App\Models\Industry;
use App\Models\User;
use App\Models\Company;
use App\Models\Sales\Sales;
use Illuminate\Http\Request;
use App\Models\Admin\UserManager;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Sales\SalesTransactions;
// use App\Models\Sales\SalesTransactionsStatus;


class SalesReportingController extends Controller
{
    public $industries = [];
    public function __construct() {
        $this->industries = $this->industries();
        $arr = [];
        foreach( $this->industries as $key => $value ) {
            $arr[$value->id] = $value->industry;
        }

        $this->industries = $arr;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $industries = $this->industries;
        return view('admin.salesreporting.index', compact('industries'));
    }

    public function ajaxIndex( Request $request ) {
        
        $transactions = Sales::select(
                'id',
                'user_id',
                'cc_number',
                DB::raw('YEAR(signup_date) as license_packages'),
                DB::raw('(YEAR(reports_expires) - YEAR(signup_date)) as year'),
                DB::raw('MONTH(signup_date) as month'),
                'signup_date',
                'reports_expires',
                'resubscribed',
                'plan_id',
                'description',
                'coupon_code',
                'created_at',
                'updated_at',
                'plan_year_id',
            )->with([
                'plans',
                'transactions' => function($transaction) {
                    // $transaction->select('id', 'cc_number', DB::raw('YEAR(signup_date) as year'), DB::raw('MONTH(signup_date) as year'), 'signup_date', 'plan_id', 'created_at');
                    $transaction->select('sales_id', 'refunded', 'transaction_id',  'amount');
                },
                'transactionsStatus',
                'user' => function($user) {
                    $user->select('email', 'firstname', 'lastname', 'username', 'phone', 'id', DB::raw('DATEDIFF(CURDATE(), created_at)/365 AS year_difference'));
                },
                'user.companies' => function($user_company) {
                    $user_company->select( 'name', 'telephone', 'phone_ext', 'industry', 'reports_left', 'reportsadditional', DB::raw('reportspackage + reportsadditional - reports_left AS reportsprocessed'), 'signup_date', 'aflac', 'reports_expire' )->orderBy('signup_date', 'desc')->withCount('employees'); // 'testng'
                },
                // 'plans' => fn($plan) => $plan->with('years')
            ]);

        #DONE
        if( ! empty($request->name) ) {
            $transactions = $transactions->whereHas( 'user', function($query) use ($request) {
                $query->where("name", "LIKE", '%' . $request->name .'%'); 
            })->orWhereHas( 'user.companies', function($user_company) use ($request) {
                $user_company->where("name", "LIKE", '%' . $request->name .'%');
            });
        }
    
        #DONE
        if( ! empty($request->industry)  ) {
            if( ! empty($request->industry) && $industry = Industry::find($request->industry) ) {
                $transactions = $transactions->whereHas( 'user.companies', function($query2) use ($industry) {
                    $query2->where('industry', 'LIKE', '%'.$industry->industry.'%');
                });
            }
        }
        
        #DONE
        if( ! empty($request->from_month) && ! empty($request->from_year) && ! empty($request->to_month) && ! empty($request->to_year) ) {
            $from = date("Y-m-d", strtotime($request->from_year .'-'. $request->from_month . '-01')) . ' 00:00:01';
            $to = date("Y-m-t", strtotime($request->to_year .'-'. $request->to_month)) . ' 23:59:59';
            //$to = date("Y-m-t", strtotime($request->to_year .'-'. $request->to_month)) . ' 11:59:59 PM';
            
            $transactions = $transactions->whereBetween('created_at', [$from, $to]);
            //$transactions = $transactions->whereBetween(DB::raw('MONTH(created_at)'), [$request->from_month, $request->to_month])->whereBetween(DB::raw('YEAR(created_at)'), [$request->from_year, $request->to_year]);
            //$sql = $transactions->toSql();
            //dd($sql);
        } else {
            $from = date('Y-m-01', strtotime(' - 1 months'));
            $to = date("Y-m-t");
            $transactions = $transactions->whereBetween('created_at', [$from, $to]);
        }
        
        /* Add condition for Searchversion */
        if ($request->Searchversion != 'Select') {
            switch ($request->Searchversion) {
                case 'Pro':
                    $transactions->whereHas('user.Sales', function ($query) {
                        $query->where('plan_id', 37);
                    });
                    break;
                case 'unlimited':
                    $transactions->whereHas('user.Sales', function ($query) {
                        $query->where('plan_id', 33);
                    });
                    break;
                case 'standard':
                    $planIds = [1, 2, 5, 9, 13, 17, 21, 25, 29];
                    $transactions->whereHas('user.Sales', function ($query) use ($planIds) {
                        $query->whereIn('plan_id', $planIds);
                    });
                    break;
                default:
                    // Handle default case if necessary
                    break;
            }
        }

        #DONE
        if( ! empty($request->limit) && $request->limit != -1 ) {
            $transactions = $transactions->limit($request->limit)->get()->toArray();
        } else {
            $transactions = $transactions->get()->toArray();
        }
        //dd($transactions);
       
       

        $all_transactions = [];
        //dd( $transactions );
        foreach( $transactions as $key => $transaction ) {
            if( ! empty( $transaction['user'] ) ) {
                $transaction['user']['user_id'] = $transaction['user']['id'];
                $transaction['user']['user_name'] = $transaction['user']['firstname'] . ' ' . $transaction['user']['lastname'];
                //$companyCount = Company::where('company_owner', $transaction['user']['id'])->count();
                //$all_transactions[$key]['company_count'] = $companyCount;
                unset($transaction['user']['id']);
                $all_transactions[$key] = array_merge($transaction, $transaction['transactions'], $transaction['transactions_status'], $transaction['user']);
                
                if( ! empty( $transaction['user']) && ! empty( $transaction['user']['companies'] ) ) {
                    
                    foreach($transaction['user']['companies'][0] as $key1 => $field) {
                        
                        if( $key1 == 'industry' ) {
                            if( is_numeric( $field ) ) {
                                $all_transactions[$key]['company_' . $key1] = $this->industries[$field];
                            } else {
                                $all_transactions[$key]['company_' . $key1] = $field;
                            }
                        } else if( $key1 == 'reports_expire' ) {
                            $all_transactions[$key]['company_' . $key1] = $field;
                        } else if( $key1 == 'employees_count' ) {
                            $all_transactions[$key]['company_' . $key1] = $field;
                        } else {
                            $all_transactions[$key]['company_' . $key1] = $field;
                        }

                    }
                }
                $all_transactions[$key]['companies_count'] = count( $all_transactions[$key]['companies'] );
                unset($all_transactions[$key]['transactions']);
                unset($all_transactions[$key]['transactions_status']);
                unset($all_transactions[$key]['user']);
                unset($all_transactions[$key]['companies']);
            }
        }
        

        foreach( $all_transactions as $kk => $tt ) {
            $all_transactions[$kk]['created_at'] = strtotime($tt['created_at']);
        }
        
        if( ! empty($request->orderByO) ) {
            switch( $request->orderByO['db_key'] ) {

                case 'signup_date' : {
                    if( strtoupper($request->orderByO['direction']) == 'ASC' ) {
                        $all_transactions = collect($all_transactions)->sortBy('created_at')->toArray();
                    } else {
                        $all_transactions = collect($all_transactions)->sortByDesc('created_at')->toArray();
                    }
                }
                break;
                
                case 'company' : $all_transactions = collect($all_transactions)->sortBy('company_name')->toArray(); break;
                case 'industry' : $all_transactions = collect($all_transactions)->sortBy('company_industry')->toArray(); break; 
                case 'name' : $all_transactions = collect($all_transactions)->sortBy('user_name')->toArray(); break;
                case 'lastname' : $all_transactions = collect($all_transactions)->sortBy('lastname')->toArray(); break;
                case 'username' : $all_transactions = collect($all_transactions)->sortBy('username')->toArray(); break;
                case 'email' : $all_transactions = collect($all_transactions)->sortBy('email')->toArray(); break;
            }
        } else {
            if( ! empty($request->orderByO) && strtoupper($request->orderByO['direction']) == 'ASC' ) {
                $all_transactions = collect($all_transactions)->sortBy('created_at')->toArray();
            } else {
                $all_transactions = collect($all_transactions)->sortByDesc('created_at')->toArray();
            }
        }

        #Filter based on the licensing_package
        if( ! empty($request->licensing_package) ) {
            foreach( $all_transactions as $key => $transaction ) {
                if( $transaction['year'] != $request->licensing_package ) {
                    unset($all_transactions[$key]);
                }
            }    
        }
        //$all_transactions['dave_data'] = 'Com-Dave';
        $all_transactions = array_values($all_transactions);
        // echo "</pre>";
        // print_r( $all_transactions );
        // echo "<pre>";
        foreach( $all_transactions as $kk => $tt ) {
            $all_transactions[$kk]['created_at'] = date("m/d/Y h:i:s A", $tt['created_at']);
            if( isset($tt['company_reports_expire']) && isset( $tt['company_signup_date'] ) ) {
                //$all_transactions[$kk]['year'] = (Int) $tt['year_difference'];
                $all_transactions[$kk]['year'] = (int)($tt['year_difference'] + 1);
                $temp_license_packages = (Int) ((time() - strtotime($tt['company_reports_expire']))/31536000);
                $all_transactions[$kk]['license_packages'] = ( (Int) $temp_license_packages < 1 ) ? 1 : $temp_license_packages;
                if( ! empty( $tt['plans'] ) ) {
                    $all_transactions[$kk]['years'] = (array)DB::table('membership_plan_years')->where('allowed_reports', $tt['plans']['allowed_reports'])->where('plan_id', $tt['plans']['id'] )->first();
                    //$all_transactions[$kk]['years'] = (array)DB::table('membership_plan_years')->where('allowed_reports', $tt['plans']['allowed_reports'])->where('year', $tt['plans']['plan_for'])->where('plan_id', $tt['plans']['id'] )->first();
                    $all_transactions[$kk]['plan_years'] = (array)DB::table('membership_plan_years')->where('id', $tt['plan_year_id'])->first();
                    //$all_transactions[$kk]['plan_years'] = (array)DB::table('membership_plan_years')->where('allowed_reports', $tt['plans']['allowed_reports'])->where('year', $tt['plans']['plan_for'])->where('plan_id', $tt['plans']['id'] )->first();;
                }
            }
        }
        
        return send_success(["transactions" => $all_transactions,'temp'=> 'dws']);
    }

    public function industries() {
        return (new UserManager())->industires();
    }

    /** Sales record delete  */
    public function salesreportingdelete(Request $request)
    {
        /*
        dd($request->all());
        $SalesTransactionsRecord = SalesTransactions::find($request->tran_id); 
        $salesRecord = Sales::find($SalesTransactionsRecord->sales_id);
        */
        $salesRecord = Sales::find($request->tran_id);
        if ($salesRecord) {
            $salesRecord->delete();
            return send_success(["success" => 'Record deleted successfully.']);
        } 
    }

    /** Sales record update */
    public function updatesalesrecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
            'firstname' => ['required'],
            'username' => ['required'],
            'lastname' => ['required'],
            'company_name' => ['required'],
            'company_reports_expire' => ['required', 'date'],
            'company_telephone' => ['required'],
            //'company_phone_ext' => ['required'],
            'company_reports_left' => ['required', 'numeric'],
            'company_industry' => ['required'],
            'amount' => ['required', 'numeric'],
            'transaction_id' => ['required', 'string'],
            'sales_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'], 
            'company_pivot.company_id' => ['required', 'numeric'],
            'username' => ['required', 'string'],
            'email' => ['required', 'email'], 
        ], [
            'firstname.required' => 'Please enter first name.',
            'lastname.required' => 'Please enter last name.',
            'company_name.required' => 'Please enter company name.',
            'company_reports_left.required' => 'Please enter Reports.',
            'amount.required' => 'Please enter Amount.',
            'company_reports_expire.required' => 'Please enter expiry date.',
            //'company_phone_ext.required' => 'Please enter Ext.',
            'company_industry.required' => 'Please enter industry.',
            'transaction_id.required' => 'Please enter transaction.',
            'company_telephone.required' => 'Please enter Phone number.',
            'username.required' => 'Please enter username.',
            'email.required' => 'Please enter a valid email address.',
        ]);
        // Validate the request data
        
        if ($validator->fails()) {
            return send_error(['msg' => 'Validation failed.', 'errors' => $validator->errors()]);
        }
    
        try {
            
            // Find the records by their respective IDs
            //$salesRecordTransactions = SalesTransactions::find($request->id);
            $salesRecordTransactions = SalesTransactions::where('transaction_id', $request->transaction_id)->first();
            $userRecord = User::find($request->user_id);
            $companyRecord = Company::find($request->company_pivot['company_id']);
            $salesRecord = Sales::find($request->sales_id);
    
            // Update records
            $userRecord->firstname = $request->firstname;
            $userRecord->lastname = $request->lastname;
            $userRecord->email = $request->email;
            $results = User::select('*')
            ->where('username', 'like', $request->username)
            ->where('id', '<>', $request->user_id)
            ->get();
            
            if ($results->count() > 0) 
            {
                return send_error(['errors_msg' => 'This username is already used. Please use another one.', 'errors' => 'Duplicate recored']);
            }
            else
            {
                $userRecord->username = $request->username;
            }
            
            $userRecord->save();
    
            $salesRecord->company_name = $request->company_name;
            $salesRecord->reports_expires = $request->company_reports_expire;
            $salesRecord->save();
    
            $companyRecord->name = $request->company_name;
            $companyRecord->reports_expire = $request->company_reports_expire;
            $companyRecord->telephone = $request->company_telephone;
            $companyRecord->phone_ext = $request->company_phone_ext;
            $companyRecord->reports_left = $request->company_reports_left;
            $companyRecord->industry = $request->company_industry;
            $companyRecord->save();
            

            $salesRecordTransactions->amount = $request->amount;
            $salesRecordTransactions->transaction_id = $request->transaction_id;
            $salesRecordTransactions->save();
    
            //DB::commit();
    
            // Return a success response
            return send_success(['successmsg' => 'Record updated successfully.']);
        } catch (\Exception $e) {
            DB::rollback();
            return send_error(['msg' => 'Record update failed.', 'error' => $e->getMessage()]);
        }
    }
}
