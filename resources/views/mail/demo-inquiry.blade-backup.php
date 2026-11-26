@component('mail::message')
<table>
    <tr>
        <td>Firstname</td>
        <td> {{$data['firstname']}} </td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td> {{$data['lastname']}} </td>
    </tr>
    <tr>
        <td>Email</td>
        <td> {{$data['email']}} </td>
    </tr>
    <tr>
        <td>Phone</td>
        <td> {{$data['phone']}} </td>
    </tr>
    <tr>
        <td>Phone Ext</td>
        <td> {{$data['phoneext']}} </td>
    </tr>
    <tr>
        <td>State</td>
        <td> {{$data['state']}} </td>
    </tr>
    <tr>
        <td>Company</td>
        <td> {{$data['company']}} </td>
    </tr>
    <tr>
        <td>Industry</td>
        <td> {{$data['industry']}} </td>
    </tr>
    <tr>
        <td># Employees</td>
        <td> {{$data['num_employees']}} </td>
    </tr>
</table>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
