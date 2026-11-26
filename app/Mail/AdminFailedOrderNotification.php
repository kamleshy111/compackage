<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminFailedOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sale;
    public $user;
    public $sales_transactions;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $sale, $user, $sales_transactions )
    {
        $this->sale = $sale;
        $this->user = $user;
        $this->sales_transactions = $sales_transactions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = config('constants.emails.admin');
        $app_name = config('app.name');
        return $this->from($from, $app_name)
            ->subject( 'The payment has failed for Order ' . $this->sale->id )
            ->markdown('emails.admin.AdminFailedOrderNotification');
    }
}
