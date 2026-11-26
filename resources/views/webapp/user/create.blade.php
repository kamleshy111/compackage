@extends('layouts.company')

@section('content')
            <div class="dashboard-container">
                <div class="">
                    <h1 class="text-2xl text-black mb-2">Companies</h1>
                    <span class="cpation text-black text-base">The following fields in the Company section are changeable: Company Name/Address, Logo, Letter to the Employee, Year Ending Date, and color customization of reports. The following section headings within the report are editable in the Company Detail page: Base Pay, Other Cash Benefits, Company Paid Benefits, and Total Compensation.</span>
                </div>
                <!-- Add new user form in the reseller section -->
                <user-create :companies="{{json_encode($companies)}}"></user-create>
            </div> 
@endsection