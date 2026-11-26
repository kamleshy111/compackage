@component('mail::message')

<p style="font-size: 14px; font-family:Arial, Helvetica, sans-serif; margin:10px 10px 10px 10px;">
    <b>
        Dear {{$user->firstname}},
    </b>
</p>

<p style="color: #000000; font-size: 12px; font-family:Arial, Helvetica, sans-serif; margin: 10px 5px 5px 10px;">
    Your COMPackage license is due to expire in {{! empty($number_of_days_left) ? $number_of_days_left : $number_of_days_left}} day(s).
</p>

<p style="color: #000000; font-size: 12px; font-family:Arial, Helvetica, sans-serif; margin: 10px 5px 5px 10px;">
    <a href="https://www.compackage.com/login">Click here</a> to log into your account using your username (below) and password. Then, from the left menu, click "Annual Renewal."
</p>

<p style="color: #000000; font-size: 12px; font-family: Arial, Helvetica, sans-serif; margin: 10px 5px 5px 10px;">
    <div style="background-color: #FFFFFF; color: #000000; padding: 3px; border: 1px solid #000000; font-size: 12px; font-family:Arial, Helvetica, sans-serif; margin: 10px 5px 5px 10px;">
        Your username is {{$user->username}}
    </div>
</p>
<p style="color: #000000; font-size: 12px; font-family:Arial, Helvetica, sans-serif; margin: 10px 5px 5px 10px;">
    <a href="{{route('cancelReminders', ['key' => $sale->id, 'type' => 1])}}">
        I’ve Already Reordered: Cancel Renewal Reminders
    </a>
</p>
<p style="color: #000000; font-size: 12px; font-family:Arial, Helvetica, sans-serif; margin: 10px 5px 5px 10px;">
    <a href="{{route('cancelReminders', ['key' => $sale->id, 'type' => 2])}}">
        I Am Not Renewing This Year: Cancel Renewal Reminders
    </a>
</p>
<p style="color: #000000; font-size: 12px; font-family:Arial, Helvetica, sans-serif; margin: 10px 5px 5px 10px;">
    <a href="{{route('cancelReminders', ['key' => $sale->id, 'type' => 3])}}">
        We Found Another Solution: Cancel Renewal Reminders
    </a>
</p>
<br>

Sincerely,<br><br>
Joe Blattner<br>
{{ config('app.name') }}
@endcomponent
