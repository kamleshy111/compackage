@component('mail::message')

Hi, 

You are refered by {{$data->sent_by}} for COMPackage.

Message: {{$data->comments}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
