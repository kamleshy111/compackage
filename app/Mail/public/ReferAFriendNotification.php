<?php

namespace App\Mail\public;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferAFriendNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

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
        $admin_email = config('constants.emails.admin');
        $app_name = config('app.name');
        return $this->from($admin_email, $app_name)->subject('COMPackage: You are reffered by your friend!')->markdown('emails.public.referafriend');
    }
}