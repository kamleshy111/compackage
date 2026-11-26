<?php
namespace App\Http\Controllers;
use DB;
use Str;
use Carbon;
use Exception;
use Stripe\Stripe;
use Stripe\PaymentMethod;
use App\Models\Industry;
use App\Mail\AdminNewOrder;
use App\Models\Admin\Coupon;
use App\Mail\CustomerNewOrder;
use App\Models\Admin\DemoInquiry;
use Illuminate\Support\Facades\Mail;
use App\Models\Employee;
use App\Mail\AdminFailedOrderNotification;
use App\Http\Controllers\Admin\CouponController;
use Illuminate\{Http\Request, Support\Facades\Validator};
use App\Models\{Company, User, Sales\SalesTransactions, Sales\SalesTransactionsStatus, Sales\Sales};
class SalesController extends Controller
{
    public $additional_report_price = 20;
    public $admin_email;
    public $support;
    public function __construct()
    {
        $this->admin_email = config('constants.emails.admin');
        $this->support = config('constants.emails.support');
    }
    public function planPurchase( Request $request )
    {
        $rules = [
			"firstname"			=>	["required", "min:3", "max:20"],
			"lastname"			=>	["required", "min:3", "max:20"],
            "username"          =>  ["required", "string", "max:50", 'unique:users,username'],
			"password"			=>	['min:6','required_with:confirm_password','same:confirm_password'],
			"confirm_password"	=>	["required", "min:6"],
			"phone_number"		=>	["required"],//+1 (795) 274-3461
            "company_name"		=>	["required"],
            //"industry"		    =>	["required"],
            //"specific_industry" =>	["required_if:industry,other"],
            "plan"		        =>	["required"],
            "plan_year"		    =>	["required"],
            "cc_name"		    =>	["required"],
            "cc_address"		=>	["required"],
            "cc_city"		    =>	["required"],
            "cc_state"		    =>	["required"],
            "cc_zip"		    =>	["required"],
		];
        if( ! auth()->user() ) {
            $rules = [
                "email"             =>  ["required", "email", "max:50", 'unique:users,email'],
                "firstname"			=>	["required", "min:3", "max:20"],
                "lastname"			=>	["required", "min:3", "max:20"],
                "username"          =>  ["required", "string", "max:50", 'unique:users,username'],
                "password"			=>	['min:6','required_with:confirm_password','same:confirm_password'],
                "confirm_password"	=>	["required", "min:6"],
                "phone_number"		=>	["required"],//+1 (795) 274-3461
                "company_name"		=>	["required"],
                //"industry"		    =>	["required"],
                //"specific_industry" =>	["required_if:industry,other"],
                "plan"		        =>	["required"],
                "plan_year"		    =>	["required"],
                "cc_name"		    =>	["required"],
                "cc_address"		=>	["required"],
                "cc_city"		    =>	["required"],
                "cc_state"		    =>	["required"],
                "cc_zip"		    =>	["required"],
            ];
        } else {
            $rules = [
                "firstname"			=>	["required", "min:3", "max:20"],
                "lastname"			=>	["required", "min:3", "max:20"],
                "username"          =>  ["required", "string", "max:50"],
                "phone_number"		=>	["required"],//+1 (795) 274-3461
                "company_name"		=>	["required"],
                //"industry"		    =>	["required"],
                //"specific_industry" =>	["required_if:industry,other"],
                "plan"		        =>	["required"],
                "plan_year"		    =>	["required"],
                "cc_name"		    =>	["required"],
                "cc_address"		=>	["required"],
                "cc_city"		    =>	["required"],
                "cc_state"		    =>	["required"],
                "cc_zip"		    =>	["required"],
            ];
        }
        /* Validate data before saving. */
		$validator = Validator::make($request->all(), $rules, [
            "email.required" => "The Email is required.",
            "email.unique" => "This email is already in use. Please either log in and REORDER or choose a different email to create a new account.",
            "firstname.required" => "The First Name is required",
            "firstname.min" => "The First Name must be at least 3 characters.",
            "firstname.max" => "The First Name must be max 20 characters.",
            "lastname.required" => "The Last Name is required",
            "lastname.min" => "The Last Name must be at least 3 characters.",
            "lastname.max" => "The Last Name must be max 20 characters.",
            "username.required" => "Username is required.",
            "phone_number.required" => "Phone Number is required.",
            "company_name.required" => "Company Name is required.",
            //"industry.required" => "Industry is required.",
            //"specific_industry.required_if" => "Specific Industry is required.",
            "plan.required" => "Please select a plan.",
            "plan_year.required" => "Please select a plan year.",
            "cc_name.required" => "Credit Card name is required.",
            "cc_address.required" => "Credit Card address is required.",
            "cc_city.required" => "Credit Card city is required.",
            "cc_state.required" => "Credit Card state is required.",
            "cc_zip.required" => "Credit Card zip is required.",
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
        $plan = DB::table('membership_plans')->where('id', $request->plan)->first();
        if( empty( $plan ) ) {
			return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => 'Please select a vaild plan.',
                    "key" => ''
                ]
            ]);
		}
        /* By default role is "USER" and if plan has unlimited reports then, create user as reseller. */
        $user_role = $plan->plan_for;
        $args = [
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'name'      => $request->firstname . ' ' . $request->lastname,
            'email'     => $request->email,
            'username'  => $request->username,
            'password'  => $request->password,
            'user_role' => $user_role,
            'status'    => 0
        ];
        if( auth()->user() ) {
            $user = auth()->user();
        } else {
            $user = ManageUsersController::createOrUpdateUserOnPlanPurchase($args);
        }
        /* Creating sales entry in the sales table */
        $order_id = $this->createSales( $request );
        if( empty( $user ) || $user == null ) {
            return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => "Something went wrong with the user. Please contact to site administrator."
                ]
            ]);
        }
        return response()->json([
            "success" => true,
            "data" =>  [
                "sales_id" => $order_id,
                "msg" => "You are registered now."
            ]
        ]);
    }
    public function createSales( Request $request )
    {
        $now = Carbon\Carbon::now();
        $plan = DB::table('membership_plans')->where('id', $request->plan)->first();
        $planYear = DB::table('membership_plan_years')->where('id', $request->plan_year)->where('plan_id', $request->plan )->first();
        /** New Plan purchase in Reminder set 0  */
        $planmember_id = User::where('email', $request->email)->first();
        if (!empty($planmember_id)) {
            $userSalesValue = Sales::where('user_id', $planmember_id->id)->first();
        
            if ($userSalesValue) {
               $userSalesValue->send_reminder_30   = 0;
               $userSalesValue->send_reminder_15   = 0;
               $userSalesValue->send_reminder_10   = 0;
               $userSalesValue->send_reminder_5    = 0;
               $userSalesValue->send_reminder_3    = 0;
               $userSalesValue->send_reminder_1    = 0;
               $userSalesValue->save();
           }
        }
        /** New user purchase in employees commit save 0 */
        if (!empty($planmember_id)) {
            $company = Company::where('company_owner', $planmember_id->id)->first();
            if (!empty($company)) {
                $commit_employees = Employee::where('company_id', $company->id)->get();
                if(!empty($commit_employees))
                {
                    foreach ($commit_employees as $commit_employee) 
                    {
                        $commit_employee->final_commited = 0;
                        $commit_employee->save();
                    }
                }
            }
        }
        $reports_get = $plan->allowed_reports;
        if( ! empty( $request->additional_report ) && is_numeric((int)$request->additional_report) && $request->additional_report > 0 ) {
            $reports_get += $request->additional_report;
        }
        $sales                  = new Sales();
        $sales->user_id         = auth()->user()->id;
        $sales->company_name    = $request->company_name;
        if( empty($request->additional_report) ) {
            $request->additional_report = 0;
        }
        
        if( ! empty($request->resubscribing) ) {
            $sales->description     = "Resub ".$plan->name." reports for ".$planYear->year." year(s) $".$planYear->price." plus ".$request->additional_report." report(s) @ $20 each";
        } else {
            $sales->description     = "Purchase ".$plan->name." reports for ".$planYear->year." year(s) $".$planYear->price." plus ".$request->additional_report." report(s) @ $20 each";
        }
        /*
        Purchase 1 to 15 reports for 2 years for $598 plus 0 report(s) @ $20 each
        #Selected Plan
        "Hosted Purchase ".$plan->name." reports for $299 plus ".$request->additional_report." report(s) @ $20 each, ExcelImportModule"
        #Additional Reports
        Purchase No package selected plus 15 report(s) @ $20 each, ExcelImportModule
        #Resubscribed plans
        "Resub 1 to 15 reports for $299 plus 15 report(s) @ $20 each, ExcelImportModule"
        */
        $sales->plan_id         = $plan->id;
        $sales->plan_year_id    = $planYear->id;
        
        $sales->reports         = $reports_get;
        $sales->signup_date     = $now->format("Y-m-d H:i:s");
        $sales->reports_expires = $now->addYears($planYear->year)->format("Y-m-d H:i:s");
        $sales->cc_name         = $request->cc_name;
        $sales->cc_address      = $request->cc_address;
        $sales->cc_city         = $request->cc_city;
        $sales->cc_state        = $request->cc_state;
        $sales->cc_zip          = $request->cc_zip;
        $sales->coupon_code     = $request->coupon_code;
        $sales->status          = 'Pending Payment';
        $sales->add_id          = auth()->user()->id;
        $sales->created_at      = Carbon::now();
        $sales->updated_at      = Carbon::now();
        $sales->save();
        $additional_reports = 0;
        if( ! empty( $request->additional_report ) && is_numeric((int)$request->additional_report) && $request->additional_report > 0 ) {
            $additional_reports = $this->additional_report_price * $request->additional_report;
        }
        $after_discount = ($planYear->price + $additional_reports);
        $couponController = new CouponController();
        //$coupon = json_decode($couponController->applyCoupon('50off'));
        $coupon = json_decode($couponController->applyCoupon($request->coupon_code));
        if( $coupon->success ) {
            if( ! empty($coupon->data->type) && $coupon->data->type == 'percentage' ) {
                $after_discount = $after_discount - (($after_discount * $coupon->data->amount)/100);
            } else if( ! empty($coupon->data->type) && $coupon->data->type == 'fixedamount' ) {
                $after_discount = $after_discount - $coupon->data->amount;
            }
        }
        
        $this->createSalesTransaction([
            'transaction_id' => Str::random(7),
            'user_id' => auth()->user()->id,
            'sales_id' => $sales->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'description' => 'Pending',
            'reports' => $reports_get,
            'rate' => 0,
            'amount' => $after_discount,
            'refunded' => 0,
            'status' => 1,
            'add_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $this->updateSalesTransactionStatus([
            'user_id' => auth()->user()->id,
            'sales_id' => $sales->id,
            'status' => 1, // Status will change according to payment status
            'details' => 'Pending',
            'add_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return $sales->id;
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
    public function purchaseAndCharge(Request $request)
    {
        // Set Stripe API key
        Stripe::setApiKey(config('cashier.secret'));
        // ERROR if sales id is not attached
        if( empty( $request->sales_id ) ) {
            return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => "Invaild order."
                ]
            ]);
        }
        $resubscribed_plan = $request->resubscribing;
        if( $request->user() ) {
            $user          = $request->user();
        } else {
            $user          = auth()->user();
        }
        
        if( $resubscribed_plan && ! empty( $user ) ) {
            $company = auth()->user()->companies()->where('companies.parent_company_id', 0)->first();
        }
        
        $plan = DB::table('membership_plans')->where('id', $request->plan)->first();
        $planYear = DB::table('membership_plan_years')->where('id', $request->plan_year)->where('plan_id', $request->plan )->first();
        $paymentMethod = $request->input('payment_method');
        try {
            $additional_reports = 0;
            if( ! empty( $request->additional_report ) && is_numeric((int)$request->additional_report) && $request->additional_report > 0 ) {
                $additional_reports = $this->additional_report_price * $request->additional_report;
            }

            $now = Carbon\Carbon::now();
            $subj = 'TCR Purchase: ';
            if( ! empty( $company ) && $resubscribed_plan ) {
                $subj = 'Resubscription: ';
                $company->name  = $request->company_name;
                if( ! empty($request->industry) && $industry = Industry::find($request->industry) ) {
                    $company->industry                      = $industry->industry;
                } else if(! empty($request->industry)) {
                    $company->industry                      = $request->industry;
                } else if(! empty($request->specific_industry)) {
                    $company->industry                      = $request->specific_industry;
                } else {
                    $company->industry                      = 'Not Specified';
                }
                $reports_get = $plan->allowed_reports;
                $additional_reports_count = 0;
                if( ! empty( $request->additional_report ) && is_numeric((int)$request->additional_report) && $request->additional_report > 0 ) {
                    $reports_get += $request->additional_report;
                    // Adding current additional reports and previous plan additional reports
                    $company->reportsadditional = $request->additional_report;// + $company->reportsadditional;
                }
                $company->reportspackage                = $reports_get;
                $company->reports_expire                = $now->addYears($planYear->year)->format("Y-m-d H:i:s");
                
                /* if( $reports_get == '-1' ) {
                    $company->reports_left = $reports_get;
                } else {
                    $company->reports_left = $reports_get + $company->reports_left - $company->reportspackage;
                } */
                $company->reports_left = $reports_get;
                $company->clear1year = 0;
                $company->clear2year = 0;
                $company->clear3year = 0;
                $company->clear4year = 0;
                
                /** New code added */
                $company->annual_refresh_date = Carbon::now()->format("Y-m-d H:i:s");

                $company->save();
                // Updating all the companies with the re-subscribed plan
                $companies = auth()->user()->companies()->where('company_user.status', 1)->get();
                foreach( $companies as $ucompany ) {
                    if( ! empty( $request->additional_report ) && is_numeric((int)$request->additional_report) && $request->additional_report > 0 ) {
                        // Adding current additional reports and previous plan additional reports
                        $ucompany->reportsadditional = $request->additional_report;// + $company->reportsadditional;
                    }
                    
                    $ucompany->reportspackage    = $reports_get;
                    $ucompany->reports_expire    = $now->format("Y-m-d H:i:s");
                    $ucompany->reports_left      = $reports_get;
                    $ucompany->clear1year        = 0;
                    $ucompany->clear2year        = 0;
                    $ucompany->clear3year        = 0;
                    $ucompany->clear4year        = 0;
                    $ucompany->save();
                }
                // Updating all the companies with the re-subscribed plan
            } else {
                $company                                = new Company();
                $company->name                          = $request->company_name;
                
                if( ! empty($request->industry) && $industry = Industry::find($request->industry) ) {
                    $company->industry                      = $industry->industry;
                } else if(! empty($request->industry)) {
                    $company->industry                      = $request->industry;
                } else if(! empty($request->specific_industry)) {
                    $company->industry                      = $request->specific_industry;
                } else {
                    $company->industry                      = 'Not Specified';
                }
                $company->telephone                     = ! empty($request->phone_number) ? $request->phone_number : '';
                $company->addr1                         = $request->cc_address;
                $company->city                          = $request->cc_city;
                $company->state                         = $request->cc_state;
                $company->zip                           = $request->cc_zip;
                
                $company->status                        = 1;
                
                $company->add_id                        = $user->id;
                $company->company_owner                 = $user->id;
                $company->health_census                 = 'Single;;;|Married;;;|Married with Kids;;;';
                $company->dental_census                 = 'Single;;;|Married;;;|Married with Kids;;;';
                $company->vision_census                 = 'Single;;;|Married;;;|Married with Kids;;;';
                $reports_get = $plan->allowed_reports;
                $additional_reports_count = 0;
                if( ! empty( $request->additional_report ) && is_numeric((int)$request->additional_report) && $request->additional_report > 0 ) {
                    $reports_get += $request->additional_report;
                    $additional_reports_count = $request->additional_report;
                }
                $company->reportspackage                = $reports_get;
                $company->reportsadditional             = $additional_reports_count;
                $company->reports_left                  = $reports_get;
                $company->reports_expire                = $now->addYears($planYear->year)->format("Y-m-d H:i:s");
                $company->parent_company_id             = 0;
                $company->is_super_company              = 1;
                $company->signup_date                   = date("Y-m-d H:i:s", time());
                $company->excel_access                  = 1;
                $company->is_reseller                   = (! empty($plan->plan_for) && $plan->plan_for == 2) ? 1 : 0 ;
                $company->sales_assoc_id                = 0;
                $company->stats_num_companies           = 0;
                $company->stats_num_employees           = 0;
                $company->stats_company_breakdown       = '';
                // $company->testing                       = false;
                $company->aflac                         = false;
                
                $company->exec_name                     = '';
                $company->exec_position                 = '';
                $company->exec_name2                    = '';
                $company->exec_position2                = '';
                $company->exec_name3                    = '';
                $company->exec_position3                = '';
                $company->letter                        = 'Enclosed is a personalized statement prepared specifically for you. This statement shows the contributions made by your company toward your total compensation package.  As you review this statement, you will see that the value of your benefits, added to your annual pay, produce your total compensation. The statement is designed to show how much your service is valued by your company.';
                $company->report_footer                 = 'This Total Compensation Report was created by YOUR COMPANY, (c) COMPackage Corp.';
                $company->month                         = 'December';
                $company->day                           = '31';
                $company->year                          = Date('Y');
                //$company->base_pay_heading              = 'Base Pay';
                //$company->other_cash_heading            = 'Other Cash Benefits';
                //$company->company_paid_heading          = 'Company Paid Benefits';
                //$company->total_compensation_heading    = 'Total Compensation';
                $company->base_pay_heading              = '';
                $company->other_cash_heading            = '';
                $company->company_paid_heading          = '';
                $company->total_compensation_heading    = '';
                $company->logo                          = '';
                $company->color1                        = '#B9D3DD'; // '#FFFF00';
                $company->color2                        = '#FF554D'; // '#FF0000';
                $company->color3                        = '#FCE086'; // '#7DA7D8';
                $company->color4                        = '#043D3C'; // '#704B97';
                $company->disclaimer                    = 'Neither COMPackage Corp. nor your employer shall be liable for any errors or omissions in this report generated using the COMPackage software.  The contents of this report are for illustrative purposes only and are not intended to be, nor shall they constitute, a definitive statement of your compensation package.  Calculation totals may differ on account of rounding.  Any questions regarding your compensation package should be directed to your employer.';
                $company->currency_symbol               = '$';
                $company->company_designation           = 'Company';
                
                /** Added New code */
                $company->annual_refresh_date = Carbon::now()->addYear()->format("Y-m-d H:i:s");
                
                $company->save();
                // Copy global benefits to company benefits
                $company->copyGlobalBenefits();
                $company->users()->syncWithoutDetaching([$user->id => ['add_id' => $user->id, 'permission_type' => 'admin', 'status' => 1]]);
            }
            

            try {
                $after_discount = ($planYear->price + $additional_reports);
                $couponController = new CouponController();
                $coupon = json_decode($couponController->applyCoupon($request->coupon_code));
                if( $coupon->success ) {
                    $coupon = Coupon::where('name', trim($request->coupon_code))->first();
                    if( ! empty($coupon->type) && $coupon->type == 'percentage' ) {
                        $after_discount = $after_discount - (($after_discount * $coupon->amount)/100);
                    } else if( ! empty($coupon->type) && $coupon->type == 'fixedamount' ) {
                        $after_discount = $after_discount - $coupon->amount;
                    }
                    $coupon->used = $coupon->used + 1;
                    $coupon->save();
                }
                $user->createOrGetStripeCustomer();
                $user->updateDefaultPaymentMethod($paymentMethod);
                //$user->charge(100 * $after_discount, $paymentMethod);
                $user->charge(100 * $after_discount, $paymentMethod, [
                    'return_url' => route('payment.success'), // Replace with actual route name
                ]);

                // Retrieve the payment method details
                $paymentMethodDetails = PaymentMethod::retrieve($paymentMethod);
                $lastFour = $paymentMethodDetails->card->last4;

                $sale = Sales::findOrFail($request->sales_id);
                $sale->coupon_code = $request->coupon_code ?? '';
                $sale->status = 'Paid';
                if( ! empty( $company ) && $resubscribed_plan ) {
                    $sale->resubscribed = 1;
                }
                $sale->save();
                $sales_transactions = SalesTransactions::where('sales_id', $request->sales_id)->first();
                $sales_transactions->description = 'Successful';
                $sales_transactions->save();
                $sales_transactions_status = SalesTransactionsStatus::where('sales_id', $request->sales_id)->first();
                $sales_transactions_status->details = "Successful";
                $sales_transactions_status->save();
                // Activating the user after successfull payment
                $user_t = User::find($user->id);
                $user_t->status = 1;
                $user_t->save();
                // Setting demo entry as becameorder if found
                $demo_inquiry = DemoInquiry::where('email', $user->email)->first();
                if( ! empty( $demo_inquiry ) ) {
                    $demo_inquiry->setAsOrder();
                }
                
            } catch( Exception $ex ) {
                $sale = Sales::findOrFail($request->sales_id);
                $sale->status = 'Failed';
                $sale->status = 0;
                $sale->save();
                
                /** New copde added in payment failed */
                $now = Carbon::now();
                if (!empty($company) && $resubscribed_plan) {
                    $expireddate = Carbon::parse($company->reports_expire);
                    if ($expireddate < $now) {
                        $company->reports_expire = $now->format("Y-m-d H:i:s");
                        $company->save();
                    } else {
                        // Report is not expired
                    }
                } else {
                    // Assuming $company is an instance of Company model
                    $company->reports_expire = $now->format("Y-m-d H:i:s");
                    $company->save();
                }

                $sales_transactions = SalesTransactions::where('sales_id', $request->sales_id)->first();
                $sales_transactions->description = 'Failed';
                $sales_transactions->status = 0;
                $sales_transactions->save();
                $sales_transactions_status = SalesTransactionsStatus::where('sales_id', $request->sales_id)->first();
                $sales_transactions_status->details = "Failed";
                $sales_transactions_status->status = 0;
                $sales_transactions_status->save();
                // Sending failed order email to admin
                Mail::to($this->support)->send(new AdminFailedOrderNotification($sale, $user, $sales_transactions));
                return response()->json([
                    "success" => false,
                    "data" =>  [
                        "msg" => "Transaction Failed: " . $ex->getMessage() . ". If this problem persists, please try another card."
                    ]
                ]);
            }
            
            $args = [
                'date'                  => date("Y-m-d H:i:s A"),
                'username'              => $user_t->username,
                'password'              => "Password",
                'email'                 => $user_t->email,
                'cc_number'             => '**** **** **** ' . $lastFour,
                'amount'                => $after_discount,
                'plan_purchased'        => $plan->name,
                'plan_years'            => $planYear->year,
                'additional_reports'    => $request->additional_report . " @ $".$this->additional_report_price." each",
                'employee_lOADER_module'=> ! empty($company->excel_access) ? "Yes" : "No",
                'subject'               => "COMPackage Order - " . $sales_transactions->transaction_id,
                'transaction_id'        => $sales_transactions->transaction_id
            ];
            
            // Sending mails to Customer
            Mail::to($user_t->email)->send(new CustomerNewOrder($args));
            $admin_args = [
                'date'                  => date("Y-m-d H:i:s A"),
                'name'                  => $user_t->firstname . ' ' . $user_t->lastname,
                'company_name'          => $company->name,
                'password'              => "Password",
                'email'                 => $user_t->email,
                'cc_number'             => '**** **** **** ' . $lastFour,
                'amount'                => $after_discount,
                'plan_purchased'        => $plan->name,
                'plan_years'            => $planYear->year,
                'additional_reports'    => (! empty($request->additional_report) ? $request->additional_report : 0) . " @ $".$this->additional_report_price." each",
                'employee_lOADER_module'=> ! empty($company->excel_access) ? "Yes" : "No",
                'subject'               => "COMPackage Order - " . $sales_transactions->transaction_id,
                'transaction_id'        => $sales_transactions->transaction_id,
                'from'                  => "receipt@compackage.com",
                // 'subject'               => "TCR Purchase: ".$user_t->name." has made a purchase for ".$planYear->year.".",
                'subject'               => $subj.$company->name."; ".$after_discount."; ".$plan->name."; ".$planYear->year." Year(s).",
                'cc'                    => "support@compackage.com",
            ];
            // Sending mails to Customer
            Mail::to($this->admin_email)->send(new AdminNewOrder($admin_args));
            return response()->json([
                "success" => true,
                "data" =>  [
                    "msg" => "Plan purchased successfully."
                ]
            ]);
            // $user->notify(new OrderProcessed($product)); 
        } catch (\Exception $exception) {
            return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => $exception->getMessage()
                ]
            ]);
        }
        return response()->json([
            "success" => false,
            "data" =>  [
                "msg" => "Somthing went wrong."
            ]
        ]);
    }
}
