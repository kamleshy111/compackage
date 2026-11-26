@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">7 Hidden Perks Not In Employee Paychecks</h1>
                    <h2 class="mb-4 text-xl text-greendarkclr font-bold">Reasons our employee compensation software can help your business.</h2>
                    <div class="mb-4">
                        <img src="{{ asset('images/COMPackage-logo.png') }}" alt="Compackage" class="w-full max-w-[200px]" />
                    </div>
                    <p class="font-serif text-[13px] mb-3 text-dgray">History suggests that few small to medium-sized companies report little more than one-third of the benefits they offer their employees. In most cases, the only report an employee gets on the cost of fringe benefits is called a "Pay Stub". Consequently, many employees think their benefits and perks amount to just 10 to 15 percent of their total compensation.</p>                
                    <p class="font-serif text-[13px] mb-3 text-dgray">The truth is, benefits and perks can represent 40 to 60 percent or more of an employee's total compensation. If you're simply looking at a pay stub, you probably aren't fully aware of your company's benefits.</p>
                    <p class="font-serif text-[13px] mb-3 text-dgray">The question becomes: How does an employer really show employees all of the benefits they receive? Our total employee compensation software can show you.</p>
                    <p class="font-serif text-[13px] mb-5 text-dgray">Total compensation software can reveal benefits that employees may not realize that they receive including:</p>
                    <ol class="pl-5 list-decimal mb-5 font-serif text-[13px]">
                        <li class="mb-1.5"><strong>Personal use of a company car</strong>. Employees who drive company cars (or take trucks home at night) are oftentimes given a car allowance or they have their car payments paid directly for them. Either way, those costs can add up to $4,000 or more each year. Add the cost of automobile insurance and fuel, and the number significantly increases.</li>
                        <li class="mb-1.5"><strong>Vacation, holiday and sick time</strong>. While an employee can look at his or her compensation report and see an hourly or weekly rate, they oftentimes can overlook their paid time off. Everyone takes this for granted, but if one of their choices is self-employment, who pays it then?</li>
                        <li class="mb-1.5"><strong>Cell phone and other technology assistance</strong>. Factor in minutes used, possible roaming charges, text messages, and your bill can add up. Since just about everyone has a cell phone these days, offering employees this perk can save them more than $500 each year.</li>
                        <li class="mb-1.5"><strong>Free parking</strong>. Work downtown or in a busy business district? The price of parking can be astronomical. When companies offer free parking (even if only because you located the business in the suburbs) or pre-tax dollars for employee parking, it may be easy to forget how much money an employee saves per year. Thousands?</li>
                        <li class="mb-1.5"><strong>Free or subsidized meals</strong>. Does your employee entertain clients over a meal? Do you bring in pizza lunches on Fridays? Do you have an open vending machine or free coffee? Highlighting these delicious perks can help your employees add up how much money they save each year.</li>
                        <li class="mb-1.5"><strong>Holiday bonus</strong>. Perhaps employees don't remember a holiday bonus in last year's compensation, but they should. This benefit is, of course, not an employer’s obligation. If your company provided a holiday bonus, employees should be aware of its impact on annual compensation.</li>
                        <li><strong>Education</strong>. Many employers pay for enrichment courses and seminars, bring in trainers, support associations that provide education. Have you sent an employee to school or paid a percentage of their tuition? These are giant strategic investments in their futures! Why not highlight that in their total compensation report?</li>
                    </ol>
                    <p class="font-serif text-[13px] mb-2 text-dgray">Sure, we've all seen pay stubs highlighting Social Security, pension, 401(k) plans, and various health and welfare insurance programs. And large companies have standard total compensation reporting products and services cost-effectively available to them. But before you let a valued employee walk away from your company because he or she thinks they’ll get more money else, where total compensation software should be considered. Total compensation reports are effective morale boosters, and now they're very inexpensive!</p>
                    <p class="font-serif text-[13px] mb-4 text-dgray">COMPackage can help. Our self-service easy-to-use total compensation reporting software helps small employers to help their employees understand the true value of their total compensation packages.</p>
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