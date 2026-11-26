<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DigitalDeliveryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $employee, $company )
    {
        $this->employee = $employee;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company_name = ($this->company->company_name_email != '') ? $this->company->company_name_email : '[COMPANY NAME]';
        $app_name = config('app.name');
        $from = config('constants.emails.info');
        $replyToEmail = config('constants.emails.replytoemail');
        //return $this->from($from, $app_name)->subject('Your '.$company_name.' Total Compensation Statement')->markdown('emails.DigitalDeliveryNotification');
        return $this->from($from, $app_name)->replyTo($replyToEmail)->subject('Your '.$company_name.' Total Compensation Statement')->markdown('emails.DigitalDeliveryNotification');
    }
}