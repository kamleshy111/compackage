@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Sample Employee Compensation Statement</h1>
                    <p class="pb-3 font-serif text-[13px] text-dgray">The sample below demonstrates just how simple and powerful COMPackage’s employee compensation statements are. These colorful, easy-to-use tools work because they can show employees exactly how much they’re earning in just a few seconds.</p>


                    <p class="pb-3 font-serif text-[13px] text-dgray">You can choose to prepare total benefit statements one at a time in less than 5-7 minutes. Or, your entire census can be completed in less than 90 minutes. Considering your time, there’s no lower cost way to produce total compensation statements than COMPackage.</p>

                    <p class="pb-3 font-serif text-[13px] text-dgray"><a href="{{route('purchaseform')}}" class="text-greendarkclr underline">Purchase benefit statement software</a> today or <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">view a free demo</a>.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Click either report image below to download the full-size PDF sample employee compensation statement. Both are included in any purchase of COMPackage – industry leaders in DIY total  compensation statement software.</p>

                    <div class="row flex flex-wrap">
                        <div class="w-full xl:w-1/2 xxl:w-1/2 lg:w-1/2 md:w-1/2"> 
                            <h3 class="text-center text-lg text-greenlightclr mb-2 font-bold">Standard Salaried Report</h3>
                            <a href="{{ asset('images/SampleReport-Salary.pdf') }}" target="_balnk"><img class="w-full" alt="Sample Compensation Statement" src="{{ asset('images/Salary-statement.jpg') }}" /></a>
                        </div>
                        <div class="w-full xl:w-1/2 xxl:w-1/2 lg:w-1/2 md:w-1/2"> 
                            <h3 class="text-center text-lg text-greenlightclr mb-2 font-bold">Annual Hourly Report</h3>
                            <a href="{{ asset('images/SampleReport-Hourly.pdf') }}" target="_balnk"><img class="w-full" alt="Sample Compensation Statement" src="{{ asset('images/Hourly-statement.jpg') }}" /></a>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="pb-3 font-serif text-[13px] text-dgray">Both reports are included in all COMPackage licenceses</p>
                    </div>
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

