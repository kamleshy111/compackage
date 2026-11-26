@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Compensation Statement Resources</h1>
                    <p class="font-serif text-[13px] text-dgray mb-3">Compensation statements are powerful tools that can help raise your workforce’s morale and boost productivity. We want you to get the most out of your employee compensation statements so your employees can see the real value they bring to your company. While some businesses use total compensation statements as a part of <a href="{{route('employeePerformanceReviews')}}" class="text-greendarkclr underline">employee annual reviews</a>, others use them for <a href="{{route('employeeRecruitment')}}" class="text-greendarkclr underline">recruiting employees</a> or <a href="{{route('employeeYearEndReports')}}" class="text-greendarkclr underline">year-end reports</a>. Decide for yourself how compensation reports can provide the biggest benefit for your company after browsing through the following resources, then <a href="{{route('home')}}" class="text-greendarkclr underline">contact COMPackage</a> today for a free <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">demo of our employee benefit statement software</a>.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><a href="{{route('hiddenEmployeeCompensationPerks')}}" class="text-greendarkclr underline">7 Hidden Perks</a> highlights how our total compensation reports can help your business. It identifies a few of the benefits employees may not realize they receive which amount to total compensation.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><a href="{{route('employeeBenefitsCost')}}" class="text-greendarkclr underline">How Much Should Employers Spend on Benefits?</a> This article provides employee benefits statistics and information designed to help employers more easily make the tough decisions about how to dole out employee benefits.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><a href="{{route('referaFriend')}}" class="text-greendarkclr underline">Refer a Friend</a> by introducing COMPackage total compensation reporting software to friends and associates.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><a href="{{route('benefitStatementGlossary')}}" class="text-greendarkclr underline">Glossary</a> of frequently used terminology across the COMPackage site.</p>
                    <hr>
                    <p class="mt-5 mb-2 font-serif text-[13px] text-dgray">View a free demo of <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">Total Compensation Reports</a>.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">View a <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">sample compensation report</a>.</p>
                    <p class="font-serif text-[13px] text-dgray">See <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of compensation reports</a>for pricing.</p>
                    <div class="mt-4"><a href="{{route('purchaseform')}}" class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-9 px-9 md:py-1.5 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg inline-block">Purchase Now</a></div>
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