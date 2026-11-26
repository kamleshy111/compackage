@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Product Reviews</h1>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <p class="font-serif text-[13px] text-dgray mb-5">COMPackage is an extremely easy software to use to create total wage/benefit statements. It is visually appealing and provides greater benefit and wage transparency for employees. We have used COMPackage for six or more years and we are happy to recommend the product.</p>
                        <div class="text-right leading-[normal]">
                            <strong class="text-[13px] text-greendarkclr leading-normal block">Jodi Ovens</strong>
                            <em class="text-[12px] leading-normal">Business Administrator & HR Manager, Housewright Construction, Newbury, Vermont</em>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <div class="flex flex-wrap -mx-1.5">
                            <div class="w-[20%] md:w-[15%] px-1.5">
                                <img src="{{ asset('images/Brett.jpg') }}" alt="Brett" class="w-full">
                            </div>
                            <div class="w-[80%] md:w-[85%] px-1.5">
                                <p class="font-serif text-[13px] text-dgray">Compackage has given my small business a Professional look at a very affordable cost.</p>
                                <div class="text-right leading-[normal]">
                                    <strong class="text-[13px] text-greendarkclr">Brett B.</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <div class="flex flex-wrap -mx-1.5">
                            <div class="w-[20%] md:w-[15%] px-1.5">
                                <img src="{{ asset('images/Jessica-Schreader.png') }}" alt="Jessica Schreader" class="w-full">
                            </div>
                            <div class="w-[80%] md:w-[85%] px-1.5">
                                <p class="font-serif text-[13px] text-dgray">COMPackage is an awesome program that has exceeded our expectations. The fact that COMPackage is Web-based is terrific because the program is so accessible and easy to use.</p>
                                <div class="text-right leading-[normal]">
                                    <strong class="text-[13px] text-greendarkclr leading-normal block">Jessica Schreader</strong>
                                    <em class="text-[12px] leading-normal">HR, Vance Metal Fabricators, Geneva, NY</em>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <p class="font-serif text-[13px] text-dgray mb-5">With COMPackage we have a detailed, big picture of the costs of employment at our company. COMPackage’s cost is a good deal and it is really user friendly.</p>
                        <div class="text-right leading-[normal]">
                            <strong class="text-[13px] text-greendarkclr leading-normal block">Stephanie Iden</strong>
                            <em class="text-[12px] leading-normal">Director of Human Resources, FBD Partnership, San Antonio, TX</em>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <div class="flex flex-wrap -mx-1.5">
                            <div class="w-[20%] md:w-[15%] px-1.5">
                                <img src="{{ asset('images/Tifanni-Vizza.png') }}" alt="Tiffani Vizza" class="w-full">
                            </div>
                            <div class="w-[80%] md:w-[85%] px-1.5">
                                <p class="font-serif text-[13px] text-dgray">COMPackage demonstrated that fringe benefits add 35% at the lowest paid workers and as high as 50% for some employees. The program certainly met our expectations.</p>
                                <div class="text-right leading-[normal]">
                                    <strong class="text-[13px] text-greendarkclr leading-normal block">Tiffani Vizza</strong>
                                    <em class="text-[12px] leading-normal">Treasurer, Napa Valley Petroleum, American Canyon, CA</em>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <div class="flex flex-wrap -mx-1.5">
                            <div class="w-[20%] md:w-[15%] px-1.5">
                                <img src="{{ asset('images/Judy-Grier.png') }}" alt="Judy Grier" class="w-full">
                            </div>
                            <div class="w-[80%] md:w-[85%] px-1.5">
                                <p class="font-serif text-[13px] text-dgray">We found the COMPackage program easy to use and it met our expectations.</p>
                                <div class="text-right leading-[normal]">
                                    <strong class="text-[13px] text-greendarkclr leading-normal block">Judy Grier</strong>
                                    <em class="text-[12px] leading-normal">Human Resources Manager, Masco Retail Sales Support, Mooresville, NC</em>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <p class="font-serif text-[13px] text-dgray mb-5">We are very happy with COMPackage. It’s an easy system to use and the tech staff is responsive and capable.</p>
                        <div class="text-right leading-[normal]">
                            <strong class="text-[13px] text-greendarkclr leading-normal block">Becky Bertolasi</strong>
                            <em class="text-[12px] leading-normal">Administrative Manager, La Monica Beverage, Loves Park, IL</em>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <p class="font-serif text-[13px] text-dgray mb-5">We had no way to calculate the true cost of our fringe benefits until we found COMPackage. Their software allows us to show employees that their fringe benefits add up to an additional 42% to 52% to their annual compensation.</p>
                        <div class="text-right leading-[normal]">
                            <strong class="text-[13px] text-greendarkclr leading-normal block">Becky Allen</strong>
                            <em class="text-[12px] leading-normal">Bullard Manufacturing, Cynthiana, KY</em>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <p class="font-serif text-[13px] text-dgray mb-5">COMPackage is very good, very easy to use. The TCR gave us a bigger picture, one that we had never seen before.</p>
                        <div class="text-right leading-[normal]">
                            <strong class="text-[13px] text-greendarkclr leading-normal block">Bill Melang</strong>
                            <em class="text-[12px] leading-normal">Owner, Ultratech Tool & Design, Fond du Lac, WI</em>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <p class="font-serif text-[13px] text-dgray mb-5">COMPackage more than met our expectations and our employees liked the annual report. They saw information that they had never seen before.</p>
                        <div class="text-right leading-[normal]">
                            <strong class="text-[13px] text-greendarkclr leading-normal block">Linda Collins</strong>
                            <em class="text-[12px] leading-normal">Payroll Administration, DYWIDAG Systems, Worldwide</em>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <p class="font-serif text-[13px] text-dgray mb-5">We like COMPackage because the program is easy to use and the technical staff is accessible and friendly. The program has met our expectations.</p>
                        <div class="text-right leading-[normal]">
                            <strong class="text-[13px] text-greendarkclr leading-normal block">Carla Reed</strong>
                            <em class="text-[12px] leading-normal">HR Administrator America’s Promise Alliance, Washington, D.C</em>
                        </div>
                    </div>
                    <div class="mb-5 border-b border-bgray pb-5">
                        <div class="flex flex-wrap -mx-1.5">
                            <div class="w-[20%] md:w-[15%] px-1.5">
                                <img src="{{ asset('images/Carmen-Detherage.png') }}" alt="Carmen Detherage" class="w-full">
                            </div>
                            <div class="w-[80%] md:w-[85%] px-1.5">
                                <p class="font-serif text-[13px] text-dgray">COMPackage gives us a much bigger picture of the cost of fringe benefits than we ever had before. It is a very good, easy to use program that exceeded our expectations.</p>
                                <div class="text-right leading-[normal]">
                                    <strong class="text-[13px] text-greendarkclr leading-normal block">Carmen Detherage</strong>
                                    <em class="text-[12px] leading-normal">Linville Management Service, Jacksonville, FL</em>
                                </div>
                            </div>
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