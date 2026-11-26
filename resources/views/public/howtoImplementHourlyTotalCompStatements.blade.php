@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">How to Implement Hourly Total Comp Statements</h1>
                    <h2 class="mb-4 text-xl text-greendarkclr font-bold">by Joe Blattner</h2>
                    <p class="font-serif text-[13px] mb-3 text-dgray">In 2004, COMPackage revolutionized the deployment of total compensation statements by developing as the world’s first DIY total compensation statements solution. Prior to COMPackage, larger companies would hire very expensive consulting services to generate total compensation statements for their employees. Smaller companies, the relative few who provided total compensation statements to their employees, would create their own – which was a very time-consuming process.</p>
                    <p class="font-serif text-[13px] mb-3 text-dgray">Today the company has once again set a new bar, by creating new features that provide great value to employers. These include:</p>
                    
                    <h3 class="mb-1.5 text-md text-dgray font-bold">Hourly Top Box Scores</h3>
                    <img src="{{ asset('images/How-to-Implement-Hourly-Total-Comp-Statements.png') }}" class="article-image-custom mb-4" alt="compackage" style="width: 100%;">

                    <p class="font-serif text-[13px] mb-3 text-dgray">For those in your workforce who are hourly workers (not salaried), this feature, exclusive to COMPackage, allows employers to go beyond just the total compensation earned to show how much these workers are actually making per hour.</p>

                    <h3 class="mb-1.5 text-md text-dgray font-bold">Illuminative Metrics™</h3>
                    <p class="font-serif text-[13px] mb-3 text-dgray">Not all financial retention benefits are part of an employee’s total compensation. E.g., ESOP value earned, shares granted, stock value currently held, dollars per mile driven – all of these might be great to show, but you don’t want them added to the total compensation. With this new feature, exclusive to COMPackage, you can illuminate a metric that isn’t a part of their total compensation in order to better recruit and retain.</p>

                    <h3 class="mb-1.5 text-md text-dgray font-bold">Digitally Delivery of Reports</h3>
                    <p class="font-serif text-[13px] mb-3 text-dgray">With today’s growing mobile work force, long distance hiring, and the new work from home movement, COMPackage has automated the process to access reports online. Employers can now digitally send a notification to any and all of their employees for them to retrieve their statement using a unique one-time-passcode.</p>

                    <h3 class="mb-1.5 text-md text-dgray font-bold">Digitally Delivery of Reports</h3>
                    <p class="font-serif text-[13px] mb-2 text-dgray">COMPackage also boasts these advantages:</p>
                    <ol class="pl-5 list-disc mb-5 font-serif text-[13px]">
                        <li class="mb-1.5">Easiest to use</li>
                        <li class="mb-1.5">Lowest cost</li>
                        <li class="mb-1.5">Virtually unlimited benefits</li>
                        <li class="mb-1.5">Fully customizable</li>
                    </ol>

                    <h3 class="mb-1.5 text-md text-dgray font-bold">Want to Learn More?</h3>
                    <p class="font-serif text-[13px] mb-2 text-dgray">Click any of these links to learn more.</p>
                    <p class="mt-5 font-serif text-[13px] text-dgray"><a href="/" class="text-greendarkclr underline">Website</a></p>
                    <p class="font-serif text-[13px] text-dgray"><a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">Sample Report</a></p>
                    <p class="font-serif text-[13px] text-dgray"><a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">Pricing</a></p>
                    <p class="font-serif text-[13px] text-dgray"><a href="https://www.compackage.com/ChooseDemo" class="text-greendarkclr underline">Demo</a></p>
                    <p class="font-serif text-[13px] text-dgray"><a href="https://www.compackage.com/contactus" class="text-greendarkclr underline">Contact Us</a></p>
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