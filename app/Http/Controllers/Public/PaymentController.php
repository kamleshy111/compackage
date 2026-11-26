<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct() {

    }

    public function chargeUser(Request $request)
    {
        /* Validate data before saving. */
		$validator = Validator::make($request->all(), [
			"first_name"				=>	["required", "max:100"],
			"last_name"					=>	["required", "max:100"],
			"user_email"				=>	["required", "max:100", "email", "unique:users,email"],
			"password"					=>	["required", "max:15"],
			"business_street_address"	=>	["required", "max:200"],
			"business_city"				=>	["required", "max:100"],
			"business_state"			=>	["required", "max:2"],
			"business_zip_code"			=>	["required", "max:5"],
			"plan_selected"				=>	["required", "string"],
		]);
		
		if($validator->fails())
		{
			$error_msg = $validator->errors()->first();
			return response()->json(array("successcode" => 2, "msg" => $error_msg));
		}			
		$selected_plan_title = "";
		$selected_plan_id = "";
		
		$user_plan_id = $request->plan_selected;
		$plan_id = 0;
		$allowed_admins = 0;
		$allowed_employees = 0;
		$allowed_guides = 0;
		$plans = $this->get_membership_plans();
		foreach($plans as $plan)
		{
			if($user_plan_id == $plan->stripe_plan_id)
			{
				$selected_plan_title = $plan->plan_title;
				$selected_plan_id = $plan->stripe_plan_id;
				$plan_id = $plan->id;
				$allowed_admins = $plan->no_of_admins_allowed;
				$allowed_employees = $plan->no_of_employees_allowed;
				$allowed_guides = $plan->no_of_guides_allowed;
			}
		}
		
		/* Check if user selected any plan and the plan exists. */
		if(!empty($selected_plan_id))
		{
			$user = new User;
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->name  = $request->first_name.' '.$request->last_name;
			$user->email = $request->user_email;
			$user->profile_name = $this->uniqueslugpublic('users', 'profile_name', $request->first_name.$request->last_name);
			$user->user_role = 'superadmin';
			$user->password = bcrypt($request->password);
			$user->selected_plan = $plan_id;
			$user->allowed_admins = $allowed_admins;
			$user->allowed_employees = $allowed_employees;
			$user->no_of_guides_allowed = $allowed_guides;
			$user->save();
			/* Save data in meta table. */
			$user_meta_data = array(
									"business_street_address" => $request->business_street_address,
									"business_street_address2" => $request->business_street_address2,
									"phone_number" => $request->user_phone,
									"business_city" => $request->business_city,
									"business_state" => $request->business_state,
									"business_zip_code" => $request->business_zip_code,
									"business_country" => "US"
								);
			$user->usermetadata()->create($user_meta_data);
			$user->newSubscription($selected_plan_title, $selected_plan_id)->create($request->payment_method);
			if($user->subscribed($selected_plan_title))
			{
				Auth::login($user, true);
				$redirect_url = route('superadmindashboard');
				/** Send an email to the seedvue admin. */
				$userdata = array(
					"name" => $request->first_name.' '.$request->last_name,
					"user_email" => $request->user_email,
					"selected_plan_title" => $selected_plan_title
				);
				$support_email = config('constants.support_email');
				Mail::to($support_email)->send(new NotifySeedvueAdmin($userdata));
				return response()->json(array("successcode" => 1, "msg" => "You have registered successfully!", "red_user" => $redirect_url));
			}
			return response()->json(array("successcode" => 2, "msg" => "Something went wrong please try again."));
		}
		return response()->json(array("successcode" => 2, "msg" => "Please select plan to subscribe."));
    }
}
