<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sales\Sales;
use App\Mail\Reminder30days;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/*
use App\Mail\Reminder1days;
use App\Mail\Reminder3days;
use App\Mail\Reminder5days;
use App\Mail\Reminder10days;
use App\Mail\Reminder15days;
use Illuminate\Support\Facades\Log;
*/

class SubscriptionExpireReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:subscription-expire-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send subscription reminder to the users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        Sales::where('send_reminder_30', 1)->whereDate('reports_expires', Carbon::now()->addMonth())->orderBy('id', 'DESC')->each(function($sale) {
            if( ! empty( $sale->user_id ) ) {
                Log::debug("Reminder of 30 days Cron is running for " . $sale->user_id);
                $user = User::find($sale->user_id);
                $number_of_days_left = 30;
                Mail::to($user->email)->send(new Reminder30days($user, $sale, $number_of_days_left));
                $sale->send_reminder_30 = 0;
                $sale->save();
            }
        });
        
        Sales::where('send_reminder_15', 1)->whereDate('reports_expires', Carbon::now()->addDays(15))->orderBy('id', 'DESC')->each(function($sale) {
            if( ! empty( $sale->user_id ) ) {
                Log::debug("Reminder of 15 days Cron is running for " . $sale->user_id);
                $user = User::find($sale->user_id);
                $number_of_days_left = 15;
                Mail::to($user->email)->send(new Reminder30days($user, $sale, $number_of_days_left));
                $sale->send_reminder_15 = 0;
                $sale->save();
            }
        });
        
        Sales::where('send_reminder_10', 1)->whereDate('reports_expires', Carbon::now()->addDays(10))->orderBy('id', 'DESC')->each(function($sale) {
            if( ! empty( $sale->user_id ) ) {
                Log::debug("Reminder of 10 days Cron is running for " . $sale->user_id);
                $user = User::find($sale->user_id);
                $number_of_days_left = 10;
                Mail::to($user->email)->send(new Reminder30days($user, $sale, $number_of_days_left));
                $sale->send_reminder_10 = 0;
                $sale->save();
            }
        });
        
        Sales::where('send_reminder_5', 1)->whereDate('reports_expires', Carbon::now()->addDays(5))->orderBy('id', 'DESC')->each(function($sale) {
            if( ! empty( $sale->user_id ) ) {
                Log::debug("Reminder of 5 days Cron is running for " . $sale->user_id);
                $user = User::find($sale->user_id);
                $number_of_days_left = 5;
                Mail::to($user->email)->send(new Reminder30days($user, $sale, $number_of_days_left));
                $sale->send_reminder_5 = 0;
                $sale->save();
            }
        });
        
        Sales::where('send_reminder_3', 1)->whereDate('reports_expires', Carbon::now()->addDays(3))->orderBy('id', 'DESC')->each(function($sale) {
            if( ! empty( $sale->user_id ) ) {
                Log::debug("Reminder of 3 days Cron is running for " . $sale->user_id);
                $user = User::find($sale->user_id);
                $number_of_days_left = 3;
                Mail::to($user->email)->send(new Reminder30days($user, $sale, $number_of_days_left));
                $sale->send_reminder_3 = 0;
                $sale->save();
            }
        });
        
        Sales::where('send_reminder_1', 1)->whereDate('reports_expires', Carbon::now()->addDays(1))->orderBy('id', 'DESC')->each(function($sale) {
            if( ! empty( $sale->user_id ) ) {
                Log::debug("Reminder of 1 days Cron is running for " . $sale->user_id);
                $user = User::find($sale->user_id);
                $number_of_days_left = 1;
                Mail::to($user->email)->send(new Reminder30days($user, $sale, $number_of_days_left));
                $sale->send_reminder_1 = 0;
                $sale->save();
            }
        });
    }
}
