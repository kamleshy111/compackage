@component('mail::message')

<p><b>A Contact Us form has been filled out: {{date("F j, Y h:i:s A", time())}}</p>
<p><b>Name:</b> {{$data->fullname}}</p>
<p><b>Business Name:</b> {{$data->businessname}}</p>
<p><b>Phone:</b> {{$data->phone}}</p>
<p><b>Email:</b> {{$data->email}}</p>
<p><b>State:</b> {{$data->state}}</p>
<p><b>Comments:</b> {{$data->comments}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent