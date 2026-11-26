@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Choose which demo to view</h1>
                    <div class="flex flex-wrap -mx-2.5">
                        <div class="w-full px-2.5 mb-5">
                            <p class="text-greendarkclr text-lg font-bold">For most businesses</p>
                            <ul class="list-disc pl-4 font-serif text-[13px] text-dgray">
                                <li>Easy to use cloud based self-service system</li>
                                <li>Digital delivery or print<span class="text-red-500">*</span></li>
                                <li>All categories can be renamed and customized</li>
                                <li>Brand with your company logo and colors</li>
                                <li>Only benefits specific to each employee appear</li>
                                <li>Non-quantifiable benefits can be shown<span class="text-red-500">*</span></li>
                                <li>12 auto calculators to speed manual entry<span class="text-red-500">*</span></li>
                                <li>Employee data can be bulk loaded from Excel</li>
                                <li>Hourly Worker Top Box Scores<span class="text-red-500">*</span></li>
                                <li>Illuminative Metrics™ to highlight specific metrics you don’t want in total compensation, e.g., # and value of shares<span class="text-red-500">*</span> </li>
                                <li>Additional 40 Custom Benefits<span class="text-red-500">*</span></li>
                                <li>Over 80 benefit category ideas provided<span class="text-red-500">*</span></li>
                                <li>US-based phone/email customer support<span class="text-red-500">*</span></li>
                            </ul>
                            <a class="rounded gradient-lgreen hover:gradient-green w-6/12 text-center py-1 px-2.5 text-lg text-white font-bold inline-block mt-2" href="{{route('compackageOnline')}}">COMPackage Standard</a>
                            <p class="text-xs mt-2 text-red-500">* Unique to COMPackage</p>
                        </div>
                        <div class="w-full px-2.5">
                            <p class="text-greendarkclr text-lg font-bold">Includes everything in Standard plus:</p>
                            <!-- <ul class="list-disc pl-4 font-serif text-[13px] text-dgray">
                                <li class="pb-2">Insurance agencies payroll companies, and similar professionals that wish to provide total compensation report services to their client companies</li>
                                <li>HR managers serving multiple divisions within their own corporation</li>
                            </ul> -->
                            <ul class="list-disc pl-4 font-serif text-[13px] text-dgray">
                                <li class="pb-2">Ability for insurance agencies, payroll companies, and similar professionals to provide total compensation reports to their client companies. You can process for as many clients as you wish for one low price. You can process the reports for them, or you can allow your clients to do it for themselves - with or without a fee from you.</li>
                                <li>Ability for companies with multiple divisions that want to segregate reports by division</li>
                            </ul>
                            <a class="rounded gradient-lgreen hover:gradient-green w-6/12 text-center py-1 px-2.5 text-lg text-white font-bold inline-block mt-2" href="{{route('compackageOnlineProfessional')}}">COMPackage Professional</a>
                        </div>
                    </div>
                    <div class="border-b border-lgray mb-6 mt-6"></div>
                    <div class="flex flex-wrap -mx-2.5">
                        <div class="w-full px-2.5">
                            <div class="pb-2 text-greendarkclr"><strong>GREAT NEWS! COMPackage 3.0 launched in 2023</strong></div>
                            <ul class="list-disc pl-4 font-serif text-[13px] text-dgray">
                                <li>Improved usability</li>
                                <li>Hourly Worker Top Box Scores (exclusive to COMPackage)</li>
                                <li>Illuminative Metrics<sup>TM</sup> (exclusive to COMPackage) to demonstrate cash value that’s not to be shown as a part of their total compensation</li>
                                <li>The ability to deliver reports digitally in one click to any number of employees via a portal (as well as print)</li>
                                <li>Additional 40 Custom Benefits</li>
                                <li>Simplified reordering / annual renewal procedures</li>
                                <li>Tools for our customer service agents to serve you even better</li>
                            </ul>
                        </div>
                    </div>
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

