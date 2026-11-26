@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Total Compensation Report Software Solutions</h1>
                    <div class="overflow-hidden max-h-[390px]">
                        <img alt="Total Compensation Report Software Solutions" src="{{ asset('images/total-compensation-statements.png') }}" class="w-full max-w-[700px]" />
                    </div>
                    <p class="font-serif text-[13px] mb-3 text-dgray">COMPackage is a feature-rich, easy-to-use system that enables businesses to create total compensation reports for staff members. These benefit statements give employees an actual account of their total compensation.</p>                
                    <p class="font-serif text-[13px] mb-3 text-dgray"><a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">View a Sample Total Compensation Report</a> or <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">request a free demo</a>.</p>
                    <p class="font-serif text-[13px] mb-3 text-dgray">Total compensation reports can dramatically <a href="{{route('reducingEmployeeTurnover')}}" class="text-greendarkclr underline">reduce employee turnover</a> and improve morale.. Now, no matter how big or small your company is, you can finally start using these powerful tools. At COMPackage, we’ve developed a <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr">total compensation report</a> that is robust enough to serve the largest corporations, yet affordable enough to work for even the smallest companies.</p>
                    <p class="font-serif text-[13px] mb-3 text-dgray">COMPackage total compensation statement software is perfect for:</p>
                    <h2 class="mb-1.5 text-lg font-bold"><a href="{{route('smallBusinessBenefitsSoftware')}}" class="text-greendarkclr underline">Total Compensation Reports for Small Businesses</a></h2>
                    <p class="font-serif text-[13px] mb-2 text-dgray">Traditional benefit reporting services are expensive because they were created to provide reports for companies with at least 100 employees. Even if small business owners wanted to provide their employees with total compensation reports, they were unable to – until now.</p>
                    <p class="font-serif text-[13px] mb-2 text-dgray">With COMPackage benefit software, small business owners have the ability to order <strong>only the number of reports</strong> they need for their business. They can then customize templates, enter data and calculate benefits, all in a secure environment. COMPackage makes things so simple that most users require only about 20 minutes to <a href="{{route('purchaseform')}}" class="text-greendarkclr">purchase the total compensation software</a> and finish their first report.</p>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Read more about the features of <a href="{{route('smallBusinessBenefitsSoftware')}}" class="text-greendarkclr underline">total compensation statements for small businesses</a>.</p>
                    <h3 class="mb-1.5 text-lg font-bold"><a href="{{route('largeBusinessBenefitsSoftware')}}" class="text-greendarkclr underline">Total Compensation Reports for Large Businesses and/or HR Departments</a></h3>
                    <p class="font-serif text-[13px] mb-2 text-dgray">For medium and large businesses with human resource departments, COMPackage offers the most robust total compensation reporting features at the lowest cost. With the innovative Employee LOADER, COMPackage benefit software can import data from an Excel spreadsheet, making it the perfect solution for companies that require reports for a high number of employees.</p>
                    <p class="font-serif text-[13px] mb-2 text-dgray">The COMPackage TCR can help large and mid-size businesses produce benefit statements in-house at a fraction of the cost they would spend contracting them out to a service bureau.</p>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Read more about the features of <a href="{{route('largeBusinessBenefitsSoftware')}}" class="text-greendarkclr underline">Total Compensation Reports for Large Businesses and/or HR Departments</a> or <a href="{{route('purchaseform')}}" class="text-greendarkclr underline">purchase today</a>.</p>
                    
                    <h4 class="mb-1.5 text-lg font-bold"><a href="{{route('insuranceAgenciesBenefitsSoftware')}}" class="text-greendarkclr underline">Total Compensation Reports: Professional Version</a></h4>
                    <p class="font-serif text-[13px] mb-2 text-dgray">The COMPackage Reporting Solutions Professional Version includes:</p>
                    <ol class="mb-3 pl-5 list-decimal font-serif text-[13px] text-dgray">
						<li>The ability to:</li>
					    <ol class="pl-5 list-disc">
					        <li>Process reports for your clients, and/or</li>
					        <li>Work iteratively in tandem with your clients by creating client sublicenses, and/or </li>
					        <li>Provide the solution to your clients' as a sublicensee and let them process it themselves.</li>
                            <li>Make changes to the template to easily provide statements in any language and currency.</li>
					      </ol>
					    <li>A "Foldering" capability, allowing you to maintain clients in separate files within the COMPackage structure.</li>
					    <li>An ability to include your company's benefits consultancy name in the footer of the total benefit statements.</li>
					    <li>Provide your clients with an unlimited number of statements– no matter how many clients you have, and no matter how many total benefit statements are generated.</li>
					</ol>
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