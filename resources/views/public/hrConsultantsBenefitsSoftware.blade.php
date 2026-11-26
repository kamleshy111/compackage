@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Employee Benefit Statements for HR Consultancy Use</h1>
                    <h2 class="mb-3 text-lg text-greendarkclr font-bold">Provide Clients an Added-Value with Employee Benefit Statements</h2>
                    <p class="font-serif text-[13px] mb-5 text-dgray">If you are an HR professional, it is now easy to give your clients the added benefit of employee compensation communication through employee benefit statements.</p>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Choosing the COMPackage Professional Version will allow you to provide unlimited statements to your clients and/or create client sublicenses.</p>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">Add Value to Your HR Services</h3>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Retention is one of today’s primary business problems, and providing employee benefit statements to clients is one of the best ways to support their employee retention rate. Few employers consider this service because they don’t know about it, or they are worried that their employees will notice that they didn’t increase their benefits this year. However, the opposite is usually true. Health insurance premiums keep climbing, not to mention all of the other benefits and perks (cell phone usage, company car, employee outings) and employers would benefit from sharing with their employees how much their total compensation really is.</p>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">For one low annual price, COMPackage lets you provide employee benefit statements to all of your clients.</h3>
                    <p class="font-serif text-[13px] mb-5 text-dgray">You can prepare the reports for clients, optionally split the work, or let them run their own reports. You can even resell the service of providing reports, if you like.</p>
                    <h4 class="mb-1.5 text-md text-dgray font-bold">Provide Effective HR Communication Services to Clients</h4>
                    <p class="mb-5 font-serif text-[13px] text-dgray">A <a href="http://blog.compackage.com/employee-benefits-communication-breeds-workplace-loyalty/" target="_blank" class="text-greendarkclr underline">recent study</a> has shown that employee benefits communication breeds workplace loyalty.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">Employee benefit statements allow your clients to effectively communicate with their employees regarding their total compensation. COMPackage is not only a salary + health benefits statement – it is a <strong>TOTAL benefit statement</strong>, with over 80 company-paid benefits and perks that employers do not often report to employees.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">By offering COMPackage employee benefit reports to your clients, you will be helping them effectively communicate with their employees, by strengthening the employer/employee relationship, thereby reducing employee turnover and the hiring costs associated.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">COMPackage's Employee Benefit Statements (Pro Version) for HR Consultants includes:</p>
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
                    <p class="mb-2 font-serif text-[13px] text-dgray">Provide your clients with an unlimited number of <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">employee benefit statements</a> - no matter how many clients you have, and no matter how many total compensation reports are generated.</p>    
                    
                    <hr>
                    <p class="mt-5 mb-2 font-serif text-[13px] text-dgray">View a free demo of <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">Total Compensation Reports</a>.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">View a <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">sample compensation report</a>.</p>
                    <p class="font-serif text-[13px] text-dgray">See <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of compensation reports</a>(Pro Version)</p>
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