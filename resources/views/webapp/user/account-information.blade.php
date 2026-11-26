@extends('layouts.company')

@section('content')
<div class="dashboard-container">
    <div>
        <h1 class="text-2xl text-black mb-2">Account Information</h1>
    </div>
    <div>
        @if ($companies->isEmpty())
            <p>No companies found.</p>
        @else
            @php
                $totalReports = 0;
                $totalRemaining = 0;
            @endphp
           
            @foreach ($companies as $companyreport)
                    @php
                        $diff = $companyreport->signup_date->diff($companyreport->reports_expires);
                        $diffInMonths = $diff->format('%m');
                        $diffInDays = $diff->format('%d');
                    @endphp

                    @if($diffInMonths > 0 || $diffInDays > 0)
                        @php $totalRemaining += $companyreport->reports; @endphp
                    @endif
                    @php $totalReports += $companyreport->reports; @endphp
            @endforeach
            <table>
                <tbody>
                    <tr>
                        <td>Company Name:</td>
                        <td><span style="display:inline-block;width:100%;">{{$company->name}}</span></td>
                    </tr>
                    <tr>
                        <td>Total Reports:</td>
                        <td>{{($totalReports >= 10000) ? 'Unlimited' : $totalReports }}</td>
                    </tr>
                    <tr> 
                        <td>Reports Remaining:</td>
                        @php
                        $Remaining = $totalReports - $employee; 
                        @endphp
                        <td>{{( $totalReports >= 10000) ? 'Unlimited' : $Remaining }}</td>
                    </tr>
                </tbody>
            </table>
            <table style="border: 1px solid;">
                <tr style="border: 1px solid;">
                    <th style="border: 1px solid;">#</th>
                    <th style="border: 1px solid;">Purchase date</th>
                    <th style="border: 1px solid;">Number reports</th>
                    <th style="border: 1px solid;">Expire date</th>
                </tr>
                <tbody>
                    @foreach ($companies as $companyreport)
                        @php
                            $diff = $companyreport->signup_date->diff($companyreport->reports_expires);
                            $diffInMonths = $diff->format('%m');
                            $diffInDays = $diff->format('%d');
                        @endphp

                        @if($diffInMonths > 0 || $diffInDays > 0)
                            @php $totalRemaining += $companyreport->reports; @endphp
                        @endif
                        @php $totalReports += $companyreport->reports; @endphp
                        <tr style="border: 1px solid;">
                            <td style="border: 1px solid;">{{ $loop->iteration }}</td>
                            <td style="border: 1px solid;">{{ date('Y-m-d', strtotime($companyreport->signup_date)) }}</td>
                            <td style="border: 1px solid;">{{ ( $companyreport->reports >= 10000) ? 'Unlimited' : $companyreport->reports }}</td>
                            <td style="border: 1px solid;">{{ date('Y-m-d', strtotime($companyreport->reports_expires)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        @endif
        
        To resubscribe to your account, please <a class="underline text-blue-400" href="{{route('purchaseform')}}">click here</a>.
    </div>
</div>    
@endsection

