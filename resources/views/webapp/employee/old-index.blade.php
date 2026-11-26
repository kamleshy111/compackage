@extends('layouts.company')

@section('content')
    {{-- Show all companies form PATH:components/webapp/employees/index.vue --}}
    <div class="dashboard-container">
        <div class="mb-5">
            <h1 class="text-2xl text-black mb-2">Employees</h1>
        </div>

        {{--<p class="text-black text-base mb-3">Your employee count will not be decreased until you select "Final Commit." Until you select "Final Commit" you can view watermarked "For Review Only" versions of reports. </p>
        <p class="text-black text-base mb-3">Clicking on "View Reports" from this page creates a zipped folder of all selected reports for you to download to your desktop. To view/print, you must unzip (extract) the folder. To unzip on Windows, right-click the folder and select "Extract All." On Mac, double-click the . zip file.</p>
        <p class="text-black text-base mb-6">If you want to print all reports at once, select all the unzipped reports you want to print. Then you can print all reports at once.</p>--}}

        @php 
        $user = auth()->user();
        if( ! empty($user) ) {
          if( $user->user_role == 2 ) {
            @endphp
            <strong>Create/Download Multiple Reports</strong>
            <p class="text-black text-base mb-3">If you want to view multiple reports, select all the employees you want to create reports for and click "Create PDF Report(s)." A zipped folder of all selected reports will be created for you to download to your desktop. </p>

            <strong>To View and/or Print Reports - Windows</strong>
            <p class="text-black text-base mb-3">1. Right-click the folder and select "Extract All." </p>
            <p class="text-black text-base mb-3">2. Select all the files (Ctrl-a)</p>
            <p class="text-black text-base mb-3">3. Right-click on any selected file and select Print. This will print all selected files.</p>

            <strong>To View and/or Print Reports - Mac</strong>
            <p class="text-black text-base mb-3">1. Double-click the .zip file to extract it</p>
            <p class="text-black text-base mb-3">2. In the extracted folder, select all of the files (Command-A) or just the files you want to print by holding down the Command key and clicking once on each file. </p>
            <p class="text-black text-base mb-3">3. Once you have the files you want to print selected, choose File > Print from the main Mac menu.</p>

            <p class="text-black text-base mb-3">If you want to view a single report, click on the employee's name and then click "Create PDF Report." </p>
            @php 
          } else if( $user->user_role == 3 ) {
            if( ! empty(request()->session()->get('user_permissions')['reports'] >= 10000) ) {
                
            } else {
                @endphp
                <p class="text-black text-base mb-3">Your employee count will not be decreased until you select "Final Commit." Until you select "Final Commit" you can view watermarked "For Review Only" versions of reports.</p>
                
                <strong>Create/Download Multiple Reports</strong>
                <p class="text-black text-base mb-3">If you want to view multiple reports, select all the employees you want to create reports for and click "Create PDF Report(s)." A zipped folder of all selected reports will be created for you to download to your desktop.</p>

                <strong>To View and/or Print Reports - Windows</strong>
                <p class="text-black text-base mb-3">1. Right-click the folder and select "Extract All." </p>
                <p class="text-black text-base mb-3">2. Select all the files (Ctrl-a)</p>
                <p class="text-black text-base mb-3">3. Right-click on any selected file and select Print. This will print all selected files.</p>

                <strong>To View and/or Print Reports - Mac</strong>
                <p class="text-black text-base mb-3">1. Double-click the .zip file to extract it</p>
                <p class="text-black text-base mb-3">2. In the extracted folder, select all of the files (Command-A) or just the files you want to print by holding down the Command key and clicking once on each file. </p>
                <p class="text-black text-base mb-3">3. Once you have the files you want to print selected, choose File > Print from the main Mac menu.</p>

                <p class="text-black text-base mb-3">If you want to view a single report, click on the employee's name and then click "Create PDF Report." </p>
                @php 
            }
          }
        }
        @endphp

        <employee-index
          plan="{{auth()->user()->defaultCompany()->getActivePlan()}}"
          :employees="{{json_encode($employees)}}"
          :empcount="{{$empcount}}"
          :inactiveempcount="{{$inactiveempcount}}"
          :activeempcount="{{$activeempcount}}"
          :totalreport="{{$totalReport}}"
          :supervisors="{{json_encode($supervisors)}}"
          :pagination="{{json_encode($pagination)}}"
          :permissions="{{json_encode($permissions)}}"
        ></employee-index>
    </div>    
@endsection
