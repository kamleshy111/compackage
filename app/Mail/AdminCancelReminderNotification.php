<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Contracts\Queue\ShouldQueue;

class AdminCancelReminderNotification extends Mailable
{
    use Queueable, SerializesModels;

    // public $admin_email;
    // public $app_name;
    public $user;
    public $sale;
    public $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id, $sale, $type)
    {
        
        $this->user = User::find($user_id) ?? null;
        $this->sale = $sale;
        $this->type = $type;
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
        return $this->from($admin_email, $app_name)->subject('The '.$this->user->name.' ('.$this->user->email.') user has cancelled the reminder.')->markdown('emails.admin.AdminCancelReminderNotification');
    }
}
