@component('mail::message')
Hi {{$employee->firstname}},

Thank you for requesting your "Total Compensation Report". Use the following One-Time Passcode to complete your PDF report download. One-Time Passcode is valid for 20 minutes.

@component('mail::button', ['url' => 'javascript:void(0);'])
    {{$employee->otp}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
