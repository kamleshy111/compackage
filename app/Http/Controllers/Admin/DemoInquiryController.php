<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Admin\DemoInquiry;
use App\Models\Admin\UserManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\DemoInquiry as DemoInquiryMail;
use App\Models\Option;

class DemoInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industries = $this->industries();
        return view('admin.demoinquiries.index', compact('industries'));
    }

    public function emailsettings()
    {
        $industries = $this->industries();
        return view('admin.demoinquiries.email-settings', compact('industries'));
    }
    

    public function ajaxIndex( Request $request ) {

        $demo_inquiries = new DemoInquiry();
    
        #DONE
        if( ! empty($request->became_order) ) {
            $demo_inquiries = DemoInquiry::where("became_order", "=", $request->became_order);
        }
        
        #DONE
        if( ! empty($request->industry)  ) {
            $demo_inquiries = $demo_inquiries->where('industry', 'LIKE', '%'.$request->industry.'%');
        }
        
        #DONE
        if( ! empty($request->from_month) && ! empty($request->from_year) && ! empty($request->to_month) && ! empty($request->to_year) ) {
            //$from = date("Y-m-d", strtotime($request->from_year .'-'. $request->from_month . '-01'));
            //$to = date("Y-m-t", strtotime($request->to_year .'-'. $request->to_month . '-01'));
            $from = date("Y-m-d H:i:s", strtotime($request->from_year . '-' . $request->from_month . '-01 00:00:00'));
            $to = date("Y-m-t H:i:s", strtotime($request->to_year . '-' . $request->to_month . '-01 23:59:59'));
            

            $demo_inquiries = $demo_inquiries->whereBetween('updated_at', [$from, $to]);
            //$demo_inquiries = $demo_inquiries->orWhereBetween('created_at', [$from, $to])->orWhereBetween('updated_at', [$from, $to]);
        }
        
        #DONE
        if( ! empty($request->orderByO) ) {
            switch( $request->orderByO['db_key'] ) {
                case 'updated_at'   : $demo_inquiries = $demo_inquiries->orderBy('updated_at', strtoupper($request->orderByO['direction']));
                    break;
                case 'company'      : $demo_inquiries = $demo_inquiries->orderBy('company', 'ASC');
                    break;
                case 'industry'     : $demo_inquiries = $demo_inquiries->orderBy('industry', 'ASC');
                    break;
                case 'name'         : $demo_inquiries = $demo_inquiries->orderBy('firstname', 'ASC')->orderBy('lastname', 'ASC');
                    break;
                case 'email'        : $demo_inquiries = $demo_inquiries->orderBy('email', 'ASC');
                    break;
                case 'phone'        : $demo_inquiries = $demo_inquiries->orderBy('phone', 'ASC');
                    break;
            }
        } else {
            $demo_inquiries = $demo_inquiries->orderBy('updated_at', 'DESC');
        }

        #DONE
        if( ! empty($request->limit) && $request->limit != -1 ) {
            $demo_inquiries = $demo_inquiries->where('deleted', 0)->limit($request->limit)->get();
        } else {
            $demo_inquiries = $demo_inquiries->where('deleted', 0)->get();
        }
        
        return send_success(["demo_inquiries" => $demo_inquiries]);
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|min:3',
            'phone' => 'required',
            // 'phoneext' => 'required|max:10',
            'state' => 'required|min:2',
            'num_employees' => 'required|numeric',
            'are_you_human' => 'required|boolean',
            // 'subscribe' => 'required|boolean'
            // company: '',
            // industry: '',
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
        
        $args = [
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'phoneext'      => $request->phoneext,
            'signup_reference_from'      => $request->signupreferencefrom,
            'OtherPleasedefine'      => $request->OtherPleasedefine,
            'UniversityWhichone'      => $request->UniversityWhichone,
            'Organizationwhichone'      => $request->Organizationwhichone,
            'WebSearchtermsearched'      => $request->WebSearchtermsearched,
            'state'         => $request->state,
            'num_employees' => $request->num_employees,
            'subscribe'     => $request->subscribe,
            'ip'            => $request->ip(),
            'became_order'  => 0,
            'deleted'       => 0,
            'company'       => $request->company,
            'industry'      => null,
            'for_use_by'    => null,
            'add_id'        => auth()->id(),
            'edit_id'       => null,
            // 'are_you_human' => $request->are_you_human,
        ];
        
        try {
            $demo_inquiry = DemoInquiry::where('email', $request->email)->first();
            if( ! empty( $demo_inquiry ) ) {
                $demo_inquiry->count += 1;
                $demo_inquiry->save();
            } else {
                DemoInquiry::create($args);
            }

            $admin = config('constants.emails.admin');
            $demo = config('constants.emails.demo');
            $amNY = new DateTime('America/New_York');
            $estTime = $amNY->format('m/d/Y h:i:s A');
            $args['date_submitted'] = $estTime; // date("m/d/Y h:i:s A");
            $args['date_submitted_mail'] = $amNY->format('F d, Y') . ' at ' . $amNY->format('h:i:s A') . ' EDT'; // date("m/d/Y h:i:s A");
            
            # Admin notification
            Mail::to($demo)->cc([$admin])->send(new DemoInquiryMail($args));

            # Customer notification
            Mail::to($request->email)->send(new \App\Mail\DemoInquiryCustomerNotification());

            // Mail::to($request->email)->send(new DemoInquiryMail($args));

            return send_success(["msg" => "Demo request submitted"]);
        } catch( \Exception $ex) {
            return send_error(["msg" => 'Something went wrong. Please try agian later', "server_msg" => $ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'phoneext' => 'required',
            'state' => 'required',
            'company' => 'required',
            'num_employees' => 'required',
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
        
        $args = [
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            // 'email'         => $request->email,
            'phone'         => $request->phone,
            'phoneext'      => $request->phoneext,
            'state'         => $request->state,
            'num_employees' => $request->num_employees,
            'company'       => $request->company,
            'industry'      => ! empty($request->industry) ? $request->industry : '',
            'ip'            => $request->ip(),
            'edit_id'       => auth()->id(),
        ];

        try {
            $demo_inquiry = DemoInquiry::where('id', $request->id)->first();
            if( ! empty( $demo_inquiry ) ) {
                $demo_inquiry->update($args);
            }
            return send_success(["msg" => "Demo request submitted, Our team will contact to you shortly."]);
        } catch( \Exception $ex) {
            return send_error(["msg" => $ex->getMessage()]);
        }
    }

    public function changeStatus( Request $request ) {
        if( empty($request->ids) ) {
            return send_error(["msg" => 'Invalid ids provided.']);
        }

        if( ! empty($request->action) && $request->action == 'mark' ) {
            foreach( $request->ids as $id ) {
                $demo_inquiry = DemoInquiry::find($id);
                if( ! empty( $demo_inquiry ) ) {
                    $demo_inquiry->update(['became_order' => 1]);
                }
            }
            return send_success(["msg" => 'The selected entries has been mark as became a order.']);
        } else if( ! empty($request->action) && $request->action == 'unmark' ) {
            foreach( $request->ids as $id ) {
                $demo_inquiry = DemoInquiry::find($id);
                if( ! empty( $demo_inquiry ) ) {
                    $demo_inquiry->update(['became_order' => 2]);
                }
            }
            return send_success(["msg" => 'The selected entries has been unmark as became a order.']);
        } else if( ! empty($request->action) && $request->action == 'delete' ) {
            foreach( $request->ids as $id ) {
                $demo_inquiry = DemoInquiry::find($id);
                if( ! empty( $demo_inquiry ) ) {
                    $demo_inquiry->update(['deleted' => 1]);
                }
            }
            return send_success(["msg" => 'The selected entries has been trashed.']);
        }
        return send_error(["msg" => 'Something went wrong.']);
    }

    /** Save email content */
    public function saveemailcontent(Request $request)
    {
        if(!empty($request->week) && !empty($request->content))
        {
            $week = $request->week; // Name of the option
            $content = $request->content; // Value of the option

            // Check if the option already exists
            $option = Option::where('option_name', $week)->first();

            if ($option) 
            {
                // If the option exists, update its value
                $option->option_value = $content;
                $option->save();
            } 
            else 
            {
                // If the option doesn't exist, create a new one
                Option::create([
                    'option_name' => $week,
                    'option_value' => $content,
                ]);
            }

            $subject_option = Option::where('option_name', 'subject_'.$week)->first();

            if ($subject_option) {
                // If the option exists, update its value
                $subject_option->option_value = $request->subject;
                $subject_option->save();
            } else {
                // If the option doesn't exist, create a new one
                Option::create([
                    'option_name' => 'subject_'.$week,
                    'option_value' => $request->subject, // Assuming $request->subject contains the subject value
                ]);
            }
            
            return send_success(["msg" => 'Update successfully message.']);
            //dd($request->all());
        }
        return send_error(["msg" => 'Something went wrong.']);
    }

    /** Get data */
    public function getemailcontent(Request $request)
    {
        if(!empty($request->week))
        {
            $selectedWeek = $request->week;

            // Assuming you have an EmailContent model with a column named 'week'
            $emailContent = Option::where('option_name', $selectedWeek)->first();
            $subject_option = Option::where('option_name', 'subject_'.$selectedWeek)->first();

            if (!empty($emailContent) || !empty($subject_option)) {
                return response()->json([
                    'success'   => true,
                    'data'      => $emailContent,
                    'subject'   => $subject_option,
                    'message'   => 'Email content retrieved successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Email content not found for the selected week'
                ], 404);
            }
        }
    }

    public function industries() {
        return (new UserManager())->industires();
    }
}
