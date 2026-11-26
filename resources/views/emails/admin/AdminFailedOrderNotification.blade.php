@component('mail::message')

Hi Joe,

The {{ config('app.name') }} has received a failed order with #{{$sale->id}}.

Below are the details:
Name: {{$user->name}}
Email: {{$user->email}}
Phone: {{$user->phone}}
Order No.: {{$sale->id}}
Transaction ID: {{$sales_transactions->transaction_id}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
