@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Using Compensation Software for Performance Reviews</h1>
                    <div class="row flex flex-wrap mb-5 md:mb-0 -mx-2.5">
                        <div class="px-2.5 w-full md:w-1/2">
                            <p class="font-serif text-[13px] mb-3 text-dgray">When we first developed our compensation software, we expected it to be used to produce year-end benefit statements or recruiting tools. However, our focus group research identified an additional value to COMPackage compensation software – annual performance reviews.</p>
                            <p class="font-serif text-[13px] mb-3 text-dgray">If you want to create performance reviews with your compensation software, you’ll have to work a little differently than you would if you were creating year-end benefit statements. Instead of providing the past year's value as you'd do in year-end reports, you’d prepare this report on a pro forma basis using last year's data to build out next year's annualized outcome.</p>
                        </div>
                        <div class="px-2.5 w-full md:w-1/2">
                            <h2 class="mb-1.5 text-lg font-bold text-dgray">COMPackage Features</h2>
                            <ul class="font-serif text-[13px] pl-5 list-disc">
                                <li class="mb-2">Only COMPackage can be performed minutes before a review</li> 
                                <li class="mb-2">Do both last years and next year’s compensation report in only minutes at no additional cost</li>
                                <li>Demonstrate the total value of all of your benefits! You’re already spending the money. You might as well tell them!</li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="font-serif text-[13px] mb-1 text-dgray">The management objective is clarity and motivation.</h3>                
                    <p class="font-serif text-[13px] mb-3 text-dgray">By handing your employee something tangible, you’ll be able to better communicate your other management messages. The compensation statements also include a salutation area perfect for communicating desired objectives (MBOs). Let this report be part of your communications tool. It's not just what you pay them; it's how much you compensate them in total.</p>                
                    <p class="font-serif text-[13px] mb-3 text-dgray">Don't miss this opportunity to communicate, especially since this secondary use of your compensation software is <strong>available at no extra cost!</strong> <a href="{{route('purchaseform')}}" class="text-greendarkclr underline">Download your COMPackage software today</a>.</p>
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