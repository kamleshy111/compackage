@extends('layouts.public')

@section('content')
    <div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Pricing of Employee Benefit Statement Software</h1>
                    <h2 class="text-xl text-greendarkclr font-bold mb-3">Benefit statements are now affordable for companies of all sizes</h2>
                    <h3 class="text-xl text-greendarkclr font-bold mb-2">Pricing Chart</h3>
                    <p class="pb-3 font-serif text-[13px] text-dgray">The pricing chart below shows the three hosted solutions:</p>
                    <ul class="list-disc mb-5 pl-5 font-serif text-[13px] text-dgray">
                        <li>Small businesses (up to 200 employees) See <a href="#PriceList" class="scroll-element text-greendarkclr underline">price list for less than 200 employees</a>.</li>
                        <li>Large businesses (unlimited annual license): $2,599.</li>
                        <li>Professional Version (annual license – use with unlimited # of clients): $2,999.</li>
                    </ul>
                    <h3 class="text-xl text-greendarkclr font-bold mb-5">Purchase Multiple License Years and Save Even More!</h3>
                    <public-compensationpricing :pplansbyyear="{{json_encode($plansByYear)}}"></public-compensationpricing>
                    <div class="text-center mt-4 mb-8 flex flex-wrap flex-row gap-4 justify-center">
                        <a href="{{route('totalCompensationDemo')}}" class="w-1/3 rounded px-6 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg">View Demo</a>
                        <a href="{{route('purchaseform')}}" class="w-1/3 rounded px-6 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg">Purchase Now</a>
                    </div>
                    <h4 class="text-md text-greendarkclr font-bold mb-5">Want us to do the work for you? <a href="/contactus" class="underline">Contact Us</a> for pricing on processing your reports.</h4>
                    <h3 class="text-xl text-greendarkclr font-bold mb-[-30px]">Features Chart</h3>
                    <div class="relative overflow-x-auto md:overflow-visible">
                        <table class="w-full text-sm text-center text-black">
                            <thead class="text-xs">
                                <tr>
                                <th scope="col" class="px-2 py-3"></th>
                                <th scope="col" class="px-2 py-3 border border-black bg-[#FFCC99]">Small Biz</th>
                                <th scope="col" class="px-2 py-3 border border-black bg-[#FFFF99]">Large Biz</th>
                                <th scope="col" class="px-2 py-3 border border-black bg-[#CCFFCC]">Pro Version</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Easy to use self-service system</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Clearly published pricing and easy, instant order & use</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Over 80 benefit category ideas provided</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">All categories can be renamed and customized</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Color report, letter and graphs all on one page (1)</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Only benefits specific to each employee appear</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Employee data can be bulk loaded from Excel</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Create reports for your entire census in a few hours</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Ability to manually edit benefit detail at any time</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Customer support most anytime at no additional cost</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Product updates throughout the year at no charge</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Hosted solution; nothing to install</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Non-quantifiable benefits can also be shown</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Show employees the number of shares they own</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Can include your company logo</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Report colors can be customized</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">12 auto calculators to speed manual entry</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black"><strong>Unlimited annual use</strong></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black"></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Brand your company on report footer</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black"></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black"></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">Sublicense customers securely and easily</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black"></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black"></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-left border border-black">You, client, or both can prepare employee reports</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black"></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black"></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                </tr>
                                <tr class="border-b border-black">
                                <td scope="row" data-label="" class="px-2 py-2 text-right border border-black">Annually renewable license:</td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFCC99]"><a href="#PriceList" class="scroll-element text-greendarkclr underline">View Pricing</a></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#FFFF99]"><a href="#PriceList" class="scroll-element text-greendarkclr underline">View Pricing</a></td>
                                <td scope="row" data-label="" class="px-2 py-2 border-r border-r-black bg-[#CCFFCC]"><a href="#PriceList" class="scroll-element text-greendarkclr underline">View Pricing</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="pb-3 font-serif text-[13px] text-dgray mb-4 mt-4 text-center">(1) Up to 23 benefits can be shown on one page. This is sufficient for most all reports. Rolls over to a 2nd page if more benefits are provided to any employee.</p>
                    <h3 class="text-xl text-greendarkclr font-bold mb-2">Start Creating Employee Compensation Statements Now</h3>
                    <p class="pb-3 font-serif text-[13px] text-dgray mb-1.5">Only COMPackage offers pricing information online and a "buy-now" feature without requiring interested parties to fill out a form or call a number for more information about our employee compensation statements. You can show your employees that their perks are benefits by experiencing our <a href="{{route('purchaseform')}}" class="text-greendarkclr underline">benefits statements software</a> today.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray mb-1.5">Upon purchase, you get immediate access over the Internet. You can order smaller employee compensation statement packages today, and larger ones later. No matter what you purchase, you can get all your money back if you cancel within 30 days.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray mb-6">All annual licensing packages are purchased on a 365-day agreement that expires on the anniversary date of the initial package purchase. (We'll remind you by e-mail prior to expiration.)</p>
                    <h3 class="text-xl text-greendarkclr font-bold mb-2">Need More Information?</h3>
                    <p class="pb-3 font-serif text-[13px] text-dgray mb-1.5">If you would like to learn more about COMPackage’s employee compensation statements, please contact us today.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray mb-1.5">You may also <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">view a sample report</a> or <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">request a free demo</a> to see how COMPackage works.</p>
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