@extends('layouts.public')

@section('content')
    <div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Why COMPackage vs Other Solutions</h1>
                    <p class="mb-3">A total compensation statement software comparison.</p>
                    <p class="mb-3">There are several dozen Total Compensation Statement (TCS) software products on the market. In addition, some Human Resource Information System (HRIS) platforms also include TCS capability in their suite of offerings – some for a fee and some at no additional cost to the user.</p>
                    <p class="mb-3">But why should someone consider COMPackage vs other platforms? Here is a list of features that are unique to COMPackage, and valuable to your organization.</p>
                    <ul class="list-disc pl-5 pb-4">
                        <li>Easiest to use, highly customizable single page benefit statement</li>
                        <li>Any benefit that you can think of can be included, even those that you can’t or wouldn’t define a dollar value to</li>
                        <li>Totally customizable category names</li>
                        <li>Platform operates for both retention and recruitment, as you can do only one, or thousands of statements at a time</li>
                        <li>You can choose to deliver in print or digitally securely</li>
                        <li>You can output both salaried employees and hourly employees showing benefits provided per hour</li>
                        <li>You can show valuable benefits that you wouldn’t want to include in the total comp calculation, like share values, ESOP value, # of shares, or most anything important to you to demonstrate. We call this invention Illuminative Metrics<sub>TM</sub>.</li>
                        <li>Uncommonly prompt customer service by email or phone</li>
                        <li>30-day unconditional Satisfaction Guarantee or your money back</li>
                    </ul>
                    <p class="mb-3">There’s more, but this is hopefully enough to encourage you to try COMPackage. You have everything to gain and nothing to lose!</p>
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