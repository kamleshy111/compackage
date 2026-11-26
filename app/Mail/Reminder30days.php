<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder30days extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $sale;
    public $number_of_days_left;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $user, $sale, $number_of_days_left )
    {
        $this->user = $user;
        $this->sale = $sale;
        $this->number_of_days_left = $number_of_days_left;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $app_name = config('app.name');
        $from = config('constants.emails.info');
        $subject = "Your subscription is about to expire in ".$this->number_of_days_left." day(s)!";
        return $this->from($from, $app_name)->subject($subject)->markdown('emails.reminders.Reminder30days');
    }
}
