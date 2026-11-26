@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Benefit Statement Software for Benefits Consultants: Adding Value to Your Client Services</h1>
                    <h2 class="mb-3 text-lg text-greendarkclr font-bold leading-[1.2]">If you are a Benefits Consultant or a Benefits Professional, COMPackage makes it simple to give your clients the added value of total benefit statements.</h2>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">A One-Stop Shop for Benefit Statements</h3>
                    <p class="font-serif text-[13px] mb-5 text-dgray">As you know, there are numerous types of benefits and perks that employers provide to their employees, besides the basics of health insurance. COMPackage benefit statement software provides over 80 of these types of benefits in its reports. Not only will your clients’ employees see the cost to their employer for their health care, but also other benefits like their company-provided cell phone, their parking/transportation costs, and holiday bonuses.</p>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">Effective Communications</h3>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Retention is one of today’s primary business problems, and according to a recent MetLife study, <a href="https://blog.compackage.com/employee-benefits-communication-breeds-workplace-loyalty/" target="_blank" class="text-greendarkclr underline">employee benefits communication breeds workplace loyalty</a>. Providing total benefit statements is one of the best ways to keep employees loyal to your clients.</p>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">Why COMPackage Benefit Statements?</h3>
                    <p class="mb-5 font-serif text-[13px] text-dgray">The COMPackage benefit statements design was based on extensive research with company presidents, payroll managers and employees alike. The product is designed for ease-of-use, flexibility, and accessibility to reports that are easy-to-read. You can build reports in bulk, partial census, even one-at-a-time.</p>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">COMPackage lets you add value to the services you provide to your clients.</h3>
                    <p class="mb-2 font-serif text-[13px] text-dgray">By using COMPackage benefit statements, you can prepare the benefit statements for your clients, optionally split the work with your clients, or you can let them run their own statements. You can even resell the service of preparing statements, if you like.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">COMPackage Total Benefit Statements (Pro Version) includes:</p>
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
                    <p class="font-serif text-[13px] text-dgray">See <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of compensation reports</a> (Pro Version)</p>
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