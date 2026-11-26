<?php

namespace App\Http\Controllers;

use App\Models\Sales\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminCancelReminderNotification;

class MailController extends Controller
{
    public function cancelReminderEmails( Request $request ) {
        if( ! empty($request->key) && ! empty($request->type) ) {
            $type = $request->type;
            $sale = Sales::find($request->key);
            $error_msg = "";
            if(empty($sale->unsubscribed))
            {
                $msg = '';
                if( $type == 1 ) {
                    $msg = 'I’ve Already Reordered: Cancel Renewal Reminders.';
                } else if( $type == 2 ) {
                    Mail::to(config('constants.emails.admin'))->send(new AdminCancelReminderNotification($sale->user_id, $sale, $type));
                    $msg = 'I Am Not Renewing This Year: Cancel Renewal Reminders.';
                } else if( $type == 3 ) {
                    Mail::to(config('constants.emails.admin'))->send(new AdminCancelReminderNotification($sale->user_id, $sale, $type));
                    $msg = 'We Found Another Solution: Cancel Renewal Reminders.';
                }
        
                $sale->send_reminder_30 = 0;
                $sale->send_reminder_15 = 0;
                $sale->send_reminder_10 = 0;
                $sale->send_reminder_5 = 0;
                $sale->send_reminder_3 = 0;
                $sale->send_reminder_1 = 0;
                $sale->unsubscribed     = 1;
                $sale->cancel_reminder_message = $msg;
                $sale->save();
            }
            else
            {
                $error_msg = "You're already unsubscribed.";
            }
            return view('public.cancel-reminder-emails', compact('error_msg'));
            //return view('public.cancel-reminder-emails');
        }
        abort(404);
    }
}
