@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Employee Benefit Statements for Small Businesses</h1>
                    <div class="flex flex-wrap -mx-2.5">
                        <div class="w-full md:w-1/2 px-2.5">
                            <h2 class="mb-3 text-lg text-greendarkclr font-bold leading-[1.2]">Choose COMPackage for small businesses</h2>
                            <p class="font-serif text-[13px] mb-2 text-dgray">The COMPackage total compensation statement software delivers the following features:</p>
                            <ul class="list-disc font-serif text-[13px] mb-2 text-dgray pl-5">
                                <li class="mb-2"><strong>Most Easy-to-Use</strong><span class="block">Easy-to-use directions. Intuitively created total compensation statement software. Simple-to-use set-up process</span></li>
                                <li class="mb-2"><strong>The World's First Self Service</strong><span class="block">The world's first online on-demand total compensation report package known available</span></li>
                                <li class="mb-2"><strong>Over 80 Benefits and Employee Perks</strong><span class="block">Over 80 benefit & perk listings to get you thinking</span></li>
                            </ul>
                        </div>
                        <div class="w-full md:w-1/2 px-2.5">
                            <h3 class="mb-1.5 text-md text-dgray font-bold">Hosted Solution</h3>
                            <p class="font-serif text-[13px] mb-2 text-dgray">Our Hosted Solution allows you to securely process your reports over the Internet. This version adds the ability to include your company's logo, include non-quantifiable benefits, and customize report colors.</p>
                            <p class="font-serif text-[13px] mb-2 text-dgray">View a free demo of <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">Total Compensation Reports</a>.</p>
                            <p class="font-serif text-[13px] mb-2 text-dgray">View a <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">sample compensation report</a>.</p>
                            <p class="font-serif text-[13px] mb-2 text-dgray">See <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of compensation reports</a> for small businesses.</p>
                            <div class="mt-4"><a href="{{route('purchaseform')}}" class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-9 px-9 md:py-1.5 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg inline-block">Purchase Now</a></div>
                        </div>
                    </div>
                    <ul class="mt-4 md:mt-0 list-disc font-serif text-[13px] mb-2 text-dgray pl-5">
                        <li class="mb-2"><strong>Over 12 Auto Calculators</strong><span class="block">Over twelve auto calculators for use in the manual version of COMPackage to auto-fill government mandatories, insurance, timeoff benefits, plus a strategy to demonstrate per employee worker comp costs</span></li>
                        <li class="mb-2"><strong>Load Common Numbers for All</strong><span class="block">Global default capability to populate any value common to many in your census, i.e. holiday bonus, free parking, staff lunches, etc.</span></li>
                        <li class="mb-2"><strong>Rerun Reports for FREE</strong><span class="block">Only pay per employee, and only those you want to report. This total compensation statement software system allows you to rerun for free any number of total compensation reports throughout the 365 day subscription period (year-end, quarterly, monthly, reviews, etc.)</span></li>
                        <li><strong>Includes the new Employee LOADER</strong><span class="block">For small companies with employee data accessible by Excel, the COMPackage Employee LOADER allows you to easily import bulk employee data, simplifying the ability to create reports for a larger number of employees. monthly, reviews, etc.</span></li>
                    </ul>
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