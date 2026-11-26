@component('mail::message')
<div class="fancybox-inner" style="overflow: auto; width: 400px; height: auto;">
    <div id="email" style="text-align: left; width: 400px; display: block;">
    <p>A new support request ticket has been submitted via the Web App.</p>
    <table>
        <tr>
            <td>First Name: </td>
            <td>{{$support_request->firstname}}</td>
        </tr>
        <tr>
            <td>Last Name: </td>
            <td>{{$support_request->lastname}}</td>
        </tr>
        <tr>
            <td>Username: </td>
            <td>{{$support_request->username}}</td>
        </tr>
        <tr>
            <td>Email: </td>
            <td>{{$support_request->email}}</td>
        </tr>
        <tr>
            <td>Phone: </td>
            <td>{{$support_request->phone}}</td>
        </tr>
        <tr>
            <td>Company Name: </td>
            <td>{{$company->name}}</td>
        </tr>
        <tr>
            <td>Company ID: </td>
            <td>{{$support_request->company_id}}</td>
        </tr>
        <tr>
            <td>Detailed Message: </td>
            <td>{{$support_request->message}}</td>
        </tr>
    </table>
    </div>
</div>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
