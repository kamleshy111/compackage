@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Use a Total Compensation Report as a Year End Report</h1>
                    <div class="row flex flex-wrap -mx-2.5 mb-5 md:mb-0">
                        <div class="px-2.5 w-full md:w-1/2">
                            <p class="font-serif text-[13px] mb-3 text-dgray"><a class="text-greendarkclr underline" href="{{route('home')}}">Total compensation reports</a> can be used as powerful year-end statements. By waiting until the end of the year to deliver a total compensation report, many companies are able to show their employees that they actually received tens of thousands of dollars in benefits throughout the year. This reminder is a powerful tool that can help increase <a class="text-greendarkclr underline" href="{{route('reducingEmployeeTurnover')}}">employee morale</a> and <a class="text-greendarkclr underline" href="{{route('reducingEmployeeTurnover')}}">reduce turnover</a>.</p>
                            <p class="font-serif text-[13px] mb-3 text-dgray">If you decide to use a total compensation report as a <a class="text-greendarkclr underline" href="{{route('employeeYearEndReports')}}">year-end report</a>, you should first review the employees you’re distributing them to. You may decide that you don’t want to give total compensation reports to your part-time workers who receive no healthcare benefits, extra perks or retirement plans. Before you decide to withhold total compensation reports from any employee, however, we recommend doing a final review to make sure the employee has no <a class="text-greendarkclr underline" href="{{route('hiddenEmployeeCompensationPerks')}}">hidden benefits</a> such as free parking, vacation time or free food.</p>
                        </div>
                        <div class="px-2.5 w-full md:w-1/2">
                            <h2 class="mb-1.5 text-lg font-bold text-dgray">COMPackage Features</h2>
                            <ul class="font-serif text-[13px] pl-5 list-disc">
                                <li>You decide when you want to perform a report, not an outside service</li> 
                                <li>Any category name can be customized by you</li>
                                <li>Only COMPackage allows you to report "non-payroll" items</li>
                                <li>Small company? No report system costs less. Large company? No report system costs so little and can be performed so efficiently.</li>
                            </ul>
                        </div>
                    </div>
                    <p class="font-serif text-[13px] mb-2 text-dgray">Make your total compensation report as effective as possible by including all the benefits you provide. Chances are, you’ll forget some the first time you draft a report. Be creative in your thought process. Our total compensation report includes 60 customizable benefit areas, and we’ve assembled a list of seven hidden perks to help you get started. Remember that if you can define it, and you can place an economic value to it, then COMPackage can deliver it in a clear, concise and colorful way.</p>                
                    <p class="font-serif text-[13px] mb-3 text-dgray">Receive more information about COMPackage's <a class="text-greendarkclr underline" href="{{route('totalCompensationStatements')}}">total compensation software</a>.</p>                
                    <p class="font-serif text-[13px] mb-3 text-dgray">If you’re ready to start letting COMPackage work for you, <a class="text-greendarkclr underline" href="{{route('totalCompensationDemo')}}">view a free total compensation report demo</a> today!</p>
                </div>
            </div>
            <div class="w-full md:w-[40%] lg:w-[30%] py-5 px-5 lg:pt-20 lg:pb-5 lg:px-8 bg-bgbrwn">
                <public-sidebar pcurrent_route="{{ url()->current() }}"></public-sidebar>
            </div>
        </div>
</div>
<div class="container mx-auto px-3.5">
    <div class="bg-greendarkclr p-5 rounded-b-lg"></div>
</div>
@endsection