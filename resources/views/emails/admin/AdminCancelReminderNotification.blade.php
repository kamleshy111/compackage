@component('mail::message')

Hi Joe,

The below user has been cancelled the reminders with the below reason. Please take further action.<br><br>
Name: {{$user->name}}<br>
Email: {{$user->email}}<br>
Phone: {{$user->phone}}<br>
Subscription expire date: {{$sale->reports_expires}}<br>
Message: {{($type == 2) ? 'I Am Not Renewing This Year: Cancel Renewal Reminders.' : 'We Found Another Solution: Cancel Renewal Reminders.' }}<br><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
