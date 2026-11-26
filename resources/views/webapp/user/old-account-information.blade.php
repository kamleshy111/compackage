@extends('layouts.company')

@section('content')
<div class="dashboard-container">
    <div>
        <h1 class="text-2xl text-black mb-2">Account Information</h1>
    </div>
    <div>
        <table>
            <tbody>
                <tr>
                    <td>Company Name:</td>
                    <td><span style="display:inline-block;width:100%;">{{$company->name}}</span></td>
                </tr>
                <tr>
                    <td>Reports Package:</td>
                    <td><span style="display:inline-block;width:100%;">{{($company->reportspackage >= 10000) ? 'Unlimited' : $company->reportspackage - $company->reportsadditional }} Reports</span></td>
                </tr>
                <tr>
                    <td>Reports Additional:</td>
                    <td><span style="display:inline-block;width:100%;">{{ $company->reportsadditional }} Reports</span></td>
                </tr>
                <tr>
                    <td>Reports Remaining:</td>
                    <td><span style="display:inline-block;width:100%;">{{($company->reportspackage >= 10000) ? 'Unlimited' : $company->reports_left }} Reports</span></td>
                </tr>
                <tr>
                    <td>Account Expiration Date:</td>
                    <td><span style="display:inline-block;width:100%;">{{date("m/d/Y H:i:s A", strtotime($company->reports_expire))}}</span></td>
                </tr>
            </tbody>
        </table>
        To resubscribe to your account, please <a class="underline text-blue-400" href="{{route('purchaseform')}}">click here</a>.
    </div>
</div>    
@endsection