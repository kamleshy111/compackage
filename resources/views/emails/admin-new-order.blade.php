@component('mail::message')

<table>
<tr>
    <td>Customer Name:</td>
    <td>{{$order['name']}}</td>
</tr>
<tr>
    <td>Company:</td>
    <td>{{$order['company_name']}}</td>
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
    <td>Employee LOADER Module:</td>
    <td>{{$order['employee_lOADER_module']}}</td>
</tr>
<tr>
    <td>Application Type:</td>
    <td>Web</td>
    </tr>
<tr>
    <td>Transaction ID:</td>
    <td>{{$order['transaction_id']}}</td>
</tr>
<tr>
    <td>DATE/TIME:</td>
    <td>{{$order['date']}}</td>
</tr>
<tr>
    <td>Amount Billed:</td>
    <td>${{$order['amount']}}</td>
</tr>
</table>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
