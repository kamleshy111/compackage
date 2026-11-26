<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\SupportRequest;
use Illuminate\Queue\SerializesModels;

class SupportRequestAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $support_request = null;
    public $company = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SupportRequest $support_request)
    {
        $this->support_request = $support_request;
        $this->company = Company::find($support_request->company_id);
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $app_name = config('app.name');
        $from = config('constants.emails.techadmin');
        return $this->from($from, $app_name)->subject('Support Request from ' . $this->support_request->firstname . ' ' . $this->support_request->lastname)->markdown('emails.support-request-admin-notification');
    }
}