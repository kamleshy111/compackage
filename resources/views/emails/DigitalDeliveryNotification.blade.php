@component('mail::message')

Dear {{$employee->firstname}},

Your Total Compensation Statement from {{! empty($company->company_name_email) ? $company->company_name_email : '[COMPANY NAME]'}} is now available for you.

To access it:
1. Go to <a href="{{url('/get-report')}}">COMPackage.com/get-report</a>
2. Enter your email and {{$company->dd_field_message_email}}
3. Follow instructions.


{{$company->closing_email}}<br>
{{$company->exec_name_email}}
@endcomponent
