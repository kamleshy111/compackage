@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Total Compensation Reports for Mid-Sized and Large Companies</h1>
                    <img src="{{ asset('images/COMPackage-logo.png') }}" class="w-full max-w-[210px] mb-5" />
                    <p class="font-serif text-[13px] mb-2 text-dgray">Before COMPackage, larger companies spent enormous amounts of time generating in-house total compensation reports. Or, they paid large sums of moneys to third-party providers.</p>
                    <p class="font-serif text-[13px] mb-4 text-dgray">Now there is a feature-rich easy-to-use system enabling any sized business to create total compensation reports for staff members. It's the world's first self-service total compensation report solution.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">Learn more about the <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of employee compensation software</a>.</p>
                    <p class="mb-5 font-serif text-[13px] text-dgray">COMPackage with Employee LOADER makes total compensation reports simple for larger businesses. Instead of entering data for each employee manually, human resource professionals can use Employee LOADER to import data from an Excel file. Not only is the employee compensation software simple to install and use, it’s also 100% secure. COMPackage total compensation software with Employee LOADER features include:                    </p>
                    <div class="flex flex-wrap -mx-2.5">
                        <div class="w-full md:w-1/2 px-2.5">
                            <h2 class="font-bold mb-2 text-[16px] text-dgray">Incredible Value - Lowest Cost</h2>
                            <ul class="mb-4 pl-5 list-disc font-serif text-[13px] text-dgray">
                                <li>All the functionality of total compensation solutions that cost thousands of dollars more.</li>
                                <li>Lets employees see what they’re really getting paid.</li>
                                <li>Lowest cost, full-featured, on-demand total compensation software available.</li>
                                <li>You determine when you want reports – not an outside service.</li>
                                <li>Great for retention – increases employees’ satisfaction with their current base pay due to a better understanding of their complete compensation package.</li>
                                <li>Great for recruiting – show candidates how generous your offer really is, even if it’s minutes before the interview. </li>
                                <li>30-day satisfaction guarantee.</li>
                            </ul>
                        </div>
                        <div class="w-full md:w-1/2 px-2.5">
                            <h3 class="font-bold mb-2 text-[16px] text-dgray">Unbelievable Features at Any Price</h3>
                            <ul class="mb-4 pl-5 list-disc font-serif text-[13px] text-dgray">
                                <li>Simple to install and use. </li>
                                <li>100% secure – software runs securely over the Internet. </li>
                                <li>Any benefit can be custom renamed.</li>
                                <li>Unlimited number of benefits and perks. System downloads with over 80 benefits and perks preprogrammed, which can be used as is or customized as needed.</li>
                                <li>Fast – purchase, download and install it, map your records to our LOADER, load your records, input any special non-payroll benefits where applicable, and be ready to print reports – all in just a few hours.</li>
                                <li>Global default capability to populate any value common to many in your census, e.g., holiday bonus, free parking, staff lunches, etc. </li>
                                <li>13 calculators to auto-fill government, 401K, time-off and insurance benefits.</li>
                                <li>Change reports throughout the year for FREE (year-end, quarterly, monthly, reviews, etc.). </li>
                                <li>Salutation area can be customized for any kind of message, from a year-end "thank you," to a performance-driven management-by-objective statement. </li>
                                <li>Reports can be printed in black-and-white or color.</li>
                                <li>Employee LOADER allows you to import data from any Excel file.</li>
                                <li>Only the categories with a financial value in it will show up on any given employee report. So, if an employee doesn't receive a benefit, the benefit name doesn't show up on that report.</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <p class="mt-5 mb-2 font-serif text-[13px] text-dgray">View a free demo of <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">Total Compensation Reports</a>.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">View a <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">sample compensation report</a>.</p>
                    <p class="font-serif text-[13px] text-dgray">See <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of compensation reports</a> for large businesses.</p>
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