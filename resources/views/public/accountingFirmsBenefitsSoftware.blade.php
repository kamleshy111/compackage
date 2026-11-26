@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Total Compensation Statement Software for Accounting Firms' Clients</h1>
                    <p class="font-serif text-[13px] mb-5 text-dgray">If you are an Accountant or work for an Accounting Firm, you are the one your clients turn to for the best advice on tracking their expenditures. Now you can provide your clients with a service that will allow them to communicate their employee benefit expenses directly to all of their employees.</p>                
                    <h2 class="mb-3 text-lg text-greendarkclr font-bold leading-[1.2]">COMPackage makes it simple to give your clients the added value of total compensation statements.</h2>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">COMPackage Total Compensation Statements Adds Value to Your Accounting Services</h3>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Are your clients fully aware of the total cost of the benefits they provide to their employees? Are they educating their employees of the value relationship provided to them by your client? The national standard of the cost of employee benefits is over <a href="{{route('employeeBenefitsCost')}}" class="text-greendarkclr underline">43% of pay</a>, and yet most employers do not realize this. Not your client, not his managers, and not his employees. Here is an opportunity for you to help your client deliver that message valuably to his staff.</p>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Seldom are employers aware of the total cost of the benefits they provide to their employees. This is because there was never before an easy way to track and reports those benefits.</p>
                    <h3 class="mb-1.5 text-md text-dgray font-bold">For one low price, COMPackage lets you add-value to the services you offer all of your clients.</h3>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Now you can offer total compensation statements to your clients. You can prepare the reports for them, optionally split the work with your clients, or you can let them run their own reports. Or, you can resell reports, if you like.</p>
                    <h4 class="mb-1.5 text-md text-dgray font-bold">Benefits communication breeds workplace loyalty (and reduces hiring costs!)</h4>
                    <p class="mb-5 font-serif text-[13px] text-dgray">According to a recent <a href="http://blog.compackage.com/employee-benefits-communication-breeds-workplace-loyalty/" target="_blank" class="text-greendarkclr underline">MetLife study</a>, employees who get communications from their employer about their benefits are twice as loyal to that employer. By effectively communicating total costs of compensation, employees have a much better understanding of their worth to the company.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">COMPackage total compensation statement software allows you to offer your clients leading-edge total compensation reports for their employees - a service that is of high value to your clients.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">COMPackage Total Compensation Statements (Pro Version) includes:</p>
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