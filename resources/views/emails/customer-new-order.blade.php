@component('mail::message')

Thank you for purchasing COMPackage! The details of this transaction are below.<br>
(Please do not reply to this automatically generated email.)


<table>
<tr>
    <td>ORDER CONFIRMATION</td>
    <td>#{{$order['transaction_id']}}</td>
</tr>
<tr>
    <td>DATE/TIME:</td>
    <td>{{$order['date']}}</td>
</tr>
<tr>
    <td>User Name:</td>
    <td>{{$order['username']}}</td>
</tr>
<tr>
    <td>Email:</td>
    <td>{{$order['email']}}</td>
</tr>
<tr>
    <td>Credit Card:</td>
    <td>{{$order['cc_number']}}</td>
</tr>
<tr>
    <td>Amount Billed:</td>
    <td>${{$order['amount']}}</td>
</tr>
<tr>
    <td>Package Purchased:</td>
    <td>{{$order['plan_purchased']}}</td>
</tr>
<tr>
    <td>Years:</td>
    <td>{{$order['plan_years']}}</td>
</tr>
<tr>
    <td>Additional Reports:</td>
    <td>{{$order['additional_reports']}}</td>
</tr>
<tr>
    <td>Login at:</td>
    <td><a href="http://www.compackage.com">http://www.compackage.com</a></td>
</tr>
</table><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent