<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DigitalDeliveryReport extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $employee )
    {
        $this->employee = $employee;
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
        return $this->from($from, $app_name)->subject('One-Time Passcode for Report Download')->markdown('emails.digitaldelivery.DigitalDeliveryReport');
    }
}
