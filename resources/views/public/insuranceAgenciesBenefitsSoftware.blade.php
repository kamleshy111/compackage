@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">For Insurance Agencies: a unique way to differentiate.</h1>
                    <h2 class="mb-3 text-lg text-greendarkclr font-bold">Choose the COMPackage Professional Version</h2>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">Another Value-Added Way to Serve</h3>
                    <p class="font-serif text-[13px] mb-5 text-dgray">In these turbulent times for Insurance Agencies, with the advent of the Healthcare Reform Act, here's another reason for customers to stick with you... that you also provide total compensation reports for their employees.</p>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">For one low annual price, COMPackage lets you provide real value-add to ALL of your clients.</h3>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Now you can offer total compensation reports to your clients. You can prepare the reports for them, optionally split the work with your clients, or you can let them run their own reports. You can even resell reports or the service to provide them, if you like.</p>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">A new way to approach clients</h3>
                    <p class="mb-5 font-serif text-[13px] text-dgray">COMPackage's software allows you to offer your clients leading-edge total compensation reports for their employees - a service that is of high perceived (and actual!) value to your clients. Some insurance agencies will even lead with total compensation reports, as a way to get in the door with companies who are reluctant to meet with "just another insurance salesman."</p>
                    <h4 class="mb-1.5 text-md text-dgray font-bold">All the features of COMPackage Total Compensation Reports... PLUS!</h4>
                    <p class="mb-2 font-serif text-[13px] text-dgray">COMPackage's Total Compensation Reports Software for Insurance Agencies includes:</p>
                    <ol class="mb-3 pl-5 list-decimal font-serif text-[13px] text-dgray">
						<li>Ability to: </li>
					    <ol class="pl-5 list-disc">
					        <li>process reports for your clients, and/or</li>
					        <li>work iteratively in tandem with your clients by creating client sublicenses, and/or </li>
					        <li>provide the solution to your clients' as a sublicensee and let them process it themselves. </li>
					      </ol>
					    <li>"Foldering" capability, allowing you to maintain clients in separate files within the COMPackage structure.</li>
					    <li>Ability to brand your agency name in the footer on your clients' total compensation reports.</li>
					</ol>
                    <p class="mb-2 font-serif text-[13px] text-dgray">Provide your clients with an unlimited number of <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">employee benefit statements</a> - no matter how many clients you have, and no matter how many total compensation reports are generated.</p>    
                    
                    <hr>
                    <p class="mt-5 mb-2 font-serif text-[13px] text-dgray">View a free demo of <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">Total Compensation Reports</a>.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">View a <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">sample compensation report</a>.</p>
                    <p class="font-serif text-[13px] text-dgray">See <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of compensation reports</a> for pricing.</p>
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