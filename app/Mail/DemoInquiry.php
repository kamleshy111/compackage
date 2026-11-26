<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        return $this->from($from, $app_name)->subject('COMPackage Demo')->markdown('mail.demo-inquiry');
    }
}
