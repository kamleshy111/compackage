<?php

namespace App\Http\Controllers\Webapp;

use Exception;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\SupportRequest;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\SupportRequestAdminNotification;

class WebappController extends Controller
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
        return view('webapp.dashboard');
    }

    /**
     * Show the home page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword()
    {
        return view('webapp.changepassword');
    }

    /**
     * Show the home page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword( Request $request )
    {
        $validator = Validator::make($request->all(), 
            [
                'current_password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ],
            [
                'current_password.required'     => 'Please enter a company name.',
                'new_password.required' => 'Please enter a industry name.',
                'new_confirm_password.sane'    => 'Please enter Address Line 1.',
            ]
        );

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
   
        try {
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return send_success(["msg" => 'Password changed successfully.']);
        } catch( Exception $ex ) {
            return send_success(["msg" => $ex->getMessage()]);
        }
   
    }

    /**
     * Show the home page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function faq()
    {
        return view('webapp.faq');
    }

    /**
     * Show the home page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function supportrequest()
    {
        $user = auth()->user();
        $company_id = $user->currentSessionCompany();
        return view('webapp.supportrequest', compact('user', 'company_id'));
    }

    /**
     * Store support ticket
     */
    public function storeSupportRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'numeric'],
            'message' => ['required', 'string'],
            'company_id' => ['required', 'numeric'],
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

        try {
            

            $support_request = new SupportRequest();
            $support_request->firstname = $request->firstname;
            $support_request->lastname = $request->lastname;
            $support_request->email = $request->email;
            $support_request->phone = $request->phone;
            $support_request->username = $request->username;
            // $support_request->company_name = $company->name;
            $support_request->company_id = $request->company_id;
            $support_request->message = $request->message;
            $support_request->save();

            $emails = getFromEmails();

            Mail::to($emails['support'])->send(new SupportRequestAdminNotification($support_request));

            return send_success(["msg" => "Your support request has been submitted. Thank you."]);
        } catch( \Exception $ex) {
            return send_error(["msg" => $ex->getMessage()]);
        }

    }
}
