<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerNewOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $order = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $app_name = config('app.name');
        $from = config('constants.emails.receipt');
        return $this->from($from, $app_name)->subject($this->order['subject'])->markdown('emails.customer-new-order');
    }
}