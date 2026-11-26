@extends('layouts.company')

@section('content')

  
  <div class="dashboard-container">
      <h1 class="text-2xl text-black mb-8">
      @php 
        $user = auth()->user();
        if( ! empty($user) ) {
          if( $user->user_role == 2 ) {
            if( ! empty(request()->session()->get('user_permissions')['reports'] > 10000) ) {
              echo 'Professional Version Dashboard';
            } else {
              echo 'Unlimited Version Dashboard';
            }
          } else if( $user->user_role == 3 ) {
            echo 'Standard Dashboard';
          }
        } else {
          echo 'Dashboard';
        }
        @endphp
      </h1>

      <h3 class="mb-2 leading-5 font-bold text-xl text-greendarkclr">WELCOME</h3>
      <p class="text-black text-base mb-6">These are the easy-to-use directions for your COMPackage software application:</p>
      <div class="mb-5">
        <p class="mb-3 cpation text-black text-base"><strong>Step 1</strong>: Enter <a class="text-[#164900] underline underline-offset-1" href="{{route('webapp.company')}}">Company</a> Information</p>
        <p class="mb-2 cpation text-black text-base">Input all of your company information in this section.</p>
        <p class="cpation text-black text-base">The following fields in the Company section are changeable: Company Name/Address, Logo, Letter to the Employee, Year Ending Date, and color customization of reports. The following section headings within the report are editable in the Company Detail page: Base Pay, Other Cash Benefits, Company Paid Benefits, and Total Compensation.</p>
      </div>
      <div class="mb-5">
        <p class="mb-3 cpation text-black text-base"><strong>Step 2</strong>: Enter <a class="text-[#164900] underline underline-offset-1" href="{{url('/webapp/benefits-list')}}">Benefits</a> Information</p>
        <p class="mb-2 cpation text-black text-base">Select all benefits that exist for any single employee throughout your company, including selecting whether it’s only paid for by the company, and/or co-paid or entirely paid for by the employee.</p>
        <p class="cpation text-black text-base">Custom benefit names and employer/employee contribution defaults (if the amount is the same for all employees) can also be inputted in the Benefits section. Once updating all of the benefits information, select the Save button at the top or bottom of the screen.</p>
      </div>
      <div class="mb-5">
        <p class="mb-3 cpation text-black text-base"><strong>Step 3A</strong>: Manual <a class="text-[#164900] underline underline-offset-1" href="{{route('webapp.employee.index')}}">Employee</a> Data Management</p>
        <p class="mb-2 cpation text-black text-base">To manually add employee data, use the Employees tab. Once an employee is added, view/edit each employee’s data in this section.</p>
        <p class="cpation text-black text-base">The Employees section is where reports can be viewed, printed, and/or digitally delivered. Reports will have a watermark until an employee is "committed" which decrements the amount of reports you have. Until then, employees can be set as inactive or deleted. If the account is Unlimited, employees can be set as inactive or deleted at any time.</p>
      </div>
      <div class="mb-5">
        <p class="mb-3 cpation text-black text-base"><strong>Step 3B</strong>: Auto-Load Employee Data <a class="text-[#164900] underline underline-offset-1" href="{{route('webapp.employeeLoader')}}">Utility</a></p>
        <p class="mb-2 cpation text-black text-base">Use the Employee Loader to bulk load employees and their data. You can start with our Excel template (there is a link on the Employee Loader page) or use your own. You must export to a CSV before uploading to COMPackage. Once you upload, you'll be guided to match the fields you are uploading with the fields you have defined on the Benefits page.</p>
        <!-- <p class="cpation text-black text-base">There is a link to download our Excel template or you may use your own.</p> -->
      </div>
      <h3 class="mt-10 mb-2 leading-5 font-bold text-xl text-greendarkclr">Demonstration Video</h3>
      <webapp-dashboard></webapp-dashboard>
      <p class="my-5 text-sm text-red-800">Still have any questions? Email <a class="underline underline-offset-1" href="mailto:support@COMPackage.com">support@COMPackage.com</a> with your question, and someone will return to you, probably within the hour during normal business hours, M-F, 9 - 6PM EST.</p>
  </div>
@endsection