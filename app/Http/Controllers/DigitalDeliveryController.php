<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use App\Models\Benefit;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use App\Models\CustomCategory;
// use Barryvdh\DomPDF\Facade\Pdf;
// use Illuminate\Support\Facades\DB;
use App\Mail\DigitalDeliveryReport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DigitalDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('digitaldelivery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:3',
            'phone' => 'required',
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

        //$employee = Employee::where('email', $request->email)->first();
        $employee = Employee::where('email', $request->email)->orderBy('id', 'DESC')->first();
        
        

        if( ! empty($employee->digital_delivery_value) ) {
            // $company = Company::find($employee->company_id);
            if( ! empty( $employee->digital_delivery_value ) ) {
                $ddid = $employee->digital_delivery_value;
            }
        }

        if( ! empty( $employee ) ) {
            if( ! empty( $ddid ) ) {
                /* if( $ddid == 'phone' ) {
                    $employee_ddid = (int)filter_var($employee->phone, FILTER_SANITIZE_NUMBER_INT);
                    $request_ddid = str_replace(["+", "-"],"",filter_var($request->phone, FILTER_SANITIZE_NUMBER_INT));
                } else { */
                    $employee_ddid = $ddid;
                    $request_ddid = $request->phone;
                /* } */

                if( strtolower($employee_ddid) == strtolower($request_ddid) ) {
                    $employee->otp = rand(100000,999999);
                    $employee->otp_sent_at = Carbon::now()->addMinutes(20);
                    $employee->save();
        
                    Mail::to($request->email)->send(new DigitalDeliveryReport($employee));
                    return send_success(["msg" => "One-Time Passcode sent successfully!"]);
                } else {
                    $last_two_digits = substr($employee_ddid, -2);
                    return send_error(["msg" => "Email matched with the database but not the Digital Delivery ID! Please check your email for Digital Delivery ID"]);
                }
            } else {
                return send_error(["msg" => "Digital Delivery ID is not set, Please contact to your employer."]);
            }
        } else {
            return send_error(["msg" => "The 'Email' and cell 'Digital Delivery ID' do not match with any of our records. Please check with your employer."]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:3',
            'phone' => 'required',
            'otp'   => 'required',
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

        //$employee = Employee::where('email', $request->email)->first();
        $employee = Employee::where('email', $request->email)->orderBy('id', 'DESC')->first();

        if( ! empty( $employee ) ) {
            
            if( $employee->otp == $request->otp ) {
                $otp_time = Carbon::parse($employee->otp_sent_at);
                $current_time = Carbon::now()->addMinutes(20);
                
                if( $otp_time < $current_time ) {
                    $string = Str::random(6);
                    return send_success(["msg" => "One-time passcode validated successfully, Now you can download your report.", "key" => $string . '_' . $employee->otp, "filename" => $employee->firstname . '-' .$employee->firstname.'.pdf']);
                } else {
                    return send_success(["msg" => "The One-time passcode has expired! Please request another."]);
                }
            } else {
                return send_error(["msg" => "Please enter a valid One-time passcode."]);    
            }
        } else {
            return send_error(["msg" => "The email and cell phone numbers do not match with any of our records. Please check with your employer."]);
        }
    }
    
    public function downloadReport(Request $request)
    {
        $otp = explode('_', $request->key)[1];
        $key = (int)filter_var($otp, FILTER_SANITIZE_NUMBER_INT);

        $employee = Employee::where('otp', $key)->first();

        if( empty( $employee ) ) {
            abort(403, 'Employee not found!');
        }

        if( Carbon::parse($employee->otp_sent_at) > Carbon::now() ) {
            // Generating reports
            (new PDFReportController)->generate_report( $employee->id, 'download' );
        } else {
            abort(403, 'Request timeout. Please re-authenticate and then, try again.');
        }
    }
}
