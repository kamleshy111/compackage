@extends('layouts.backup.publichomebackup')

@section('content')
<div style="background-image:url('{{ asset('images/promo-bg.jpg') }}')" class="px-3.5 bg-contain bg-repeat-x bg-top">
    <div class="max-w-[1040px] w-full mx-auto">
        <div class="flex flex-wrap row">
            <div class="relative w-full md:w-[62%]">
            
     <!-- <img class="w-full" src="{{ asset('images/home-page-photo-change-to-2023-_1b_320.webp') }}" 
     srcset="{{ asset('images/home-page-photo-change-to-2023-_1b_320.webp') }} 480w, {{ asset('images/home-page-photo-change-to-2023-_1b_.webp') }}" alt="They think it's this... but you know it's this!" loading="lazy" /> -->
     <!-- <img class="w-full" src="{{ asset('images/home-page-photo-change-to-2023-_1b_320-krcustomreport.webp') }}" 
     srcset="{{ asset('images/home-page-photo-change-to-2023-_1b_320-krcustomreport.webp') }} 480w, {{ asset('images/home-page-photo-change-to-2023-_1b_-optimized.webp') }}" alt="They think it's this... but you know it's this!"  /> -->
     <img class="w-full" src="{{ asset('images/home-page-photo-change-to-2024-_1b_320-krcustomreport.webp') }}" 
     srcset="{{ asset('images/home-page-photo-change-to-2024-_1b_320-krcustomreport.webp') }} 480w, {{ asset('images/home-page-photo-change-to-2024-_1b_-optimized.webp') }}" alt="They think it's this... but you know it's this!"  />
     
                <div class="absolute md:top-5 lg:top-5 xl:top-[auto] xl:-bottom-4 -bottom-4 leading-4 opacity-90 flex justify-center items-center flex-wrap px-5 mx-auto w-36 h-36 rounded-full bg-dgreenclr border-8 border-white text-base text-center text-white font-bold">
                    <span>30 Day Money-Back Guarantee
                    <a href="{{route('30day')}}" class="mt-3 justify-center items-center flex text-sm text-center text-white font-bold">Learn More</a>
                    </span>
                </div>
                <div class="my-2.5 flex flex-wrap gap-1.5 justify-center md:flex lg:flex xl:hidden hidden">
                        <a href="{{route('sampleTotalCompensationReport')}}" class="w-1/3 md:w-auto rounded px-2 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-sm">View Sample</a>
                        <a href="{{route('compensationStatementPricing')}}" class="w-1/3 md:w-auto rounded px-2 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-sm">View Pricing</a>
                        <a href="{{route('purchaseform')}}" class="w-1/3 md:w-auto rounded px-2 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-sm">Purchase</a>
                        <a href="{{route('referaFriend')}}" class="w-1/3 md:w-auto rounded px-2 py-2.5 leading-4 text-center gradient-orange hover:gradient-lgreen text-white font-sans font-bold text-sm">Refer Friend</a>  
                </div>
            </div>
            <!-- <div class="w-full md:w-[38%] px-5 pt-5 pb-5 bg-contain bg-repeat-x bg-left relative" style="background-image:url('{{ asset('images/promo-bg-right.jpg') }}')"> -->
            <div class="w-full md:w-[38%] px-5 pt-5 pb-5 bg-contain bg-repeat-x bg-left relative" style="background: rgb(238,238,238);background: linear-gradient(hsl(0 0% 96% / 1) 0%, hsl(0 0% 73% / 1) 100%)">
                <div>
                    <h1 class="leading-8 font-bold text-2xl text-dgreenclr pr-[72px]"><span class="block leading-6 font-bold text-tgray text-2xl">The World's First</span>Easy-to-Use Total Compensation Statements</h1>
                    <div class="mt-3 mb-5">
                        <a href="{{route('totalCompensationDemo')}}">
                            <img src="{{ asset('images/compackage-homepage-view-demo320.webp') }}" 
                            srcset="{{ asset('images/compackage-homepage-view-demo320.webp') }} 480w, {{ asset('images/compackage-homepage-view-demo.webp') }}" src="{{ asset('images/compackage-homepage-view-demo.webp') }}" alt="View Demo" class="mx-auto" />
                        </a>
                    </div>
                    <div class="mb-4">
                        <h2 class="leading-8 font-bold text-2xl text-dgreenclr pr-[10px]">One of the most cost-effective ways to improve employee retention and recruitment.</h2> 
                    </div>
                    <div class="flex flex-wrap gap-1.5 justify-center md:hidden lg:hidden xl:flex flex">
                        <a href="{{route('sampleTotalCompensationReport')}}" class="w-1/3 md:w-auto rounded px-2 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-sm">View Sample</a>
                        <a href="{{route('compensationStatementPricing')}}" class="w-1/3 md:w-auto rounded px-2 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-sm">View Pricing</a>
                        <a href="{{route('purchaseform')}}" class="w-1/3 md:w-auto rounded px-2 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-sm">Purchase</a>
                        <a href="{{route('referaFriend')}}" class="w-1/3 md:w-auto rounded px-2 py-2.5 leading-4 text-center gradient-orange hover:gradient-lgreen text-white font-sans font-bold text-sm">Refer Friend</a>  
                    </div>
                </div>    
                <div class="w-[72px] h-[72px] bg-[#114cd3] inline-block top-3 right-3 absolute"></div>
            </div>
        </div>
    </div>    
</div>
<div class="container mx-auto px-3.5">
    <div class="bg-greendarkclr p-2.5"></div>
    <div class="bg-white p-2.5">
        <div class="row flex flex-wrap -mx-2.5">
            <div class="w-full mb-7 md:mb-0 md:w-1/4 px-2.5">
                <h3 class="mb-4 leading-5 font-bold text-xl text-greendarkclr">View Free Demo and Sample</h3>
                <a href="{{route('totalCompensationDemo')}}" class="font-serif text-[#164900] text-[13px] underline underline-offset-1 font-bold leading-4">View a Demo Today.</a>
                <p class="mb-2 font-serif text-tgray text-[13px] leading-4">See how easy it is to use COMPackage Total Compensation Statements.</p>
                <p class="font-serif text-tgray text-[13px] leading-4">There are over 80+ employee benefit suggestions included in COMPackage Total Compensation Reports.</p>
                <a href="{{route('sampleTotalCompensationReport')}}" class="font-serif text-[#164900] inline-block text-[13px] underline underline-offset-1 font-bold leading-4">View a sample total compensation report.</a>
            </div>
            <div class="w-full mb-7 md:mb-0 md:w-1/4 px-2.5">
                <h3 class="mb-4 leading-5 font-bold text-xl text-greendarkclr">Why Use Total Benefit Statements?</h3>
                <a href="{{route('employeeBenefitsCost')}}" class="font-serif text-[#164900] text-[13px] underline underline-offset-1 font-bold leading-4">Cost of Employee Benefits.</a>
                <p class="mb-2 font-serif text-tgray text-[13px] leading-4">How much should your company be spending?</p>
                <a href="{{route('reducingEmployeeTurnover')}}" class="font-serif text-[#164900] inline-block text-[13px] underline underline-offset-1 font-bold leading-4">Reducing Employee Turnover -</a>
                <p class="font-serif text-tgray text-[13px] leading-4">Showing employees their total benefits can make them think twice about moving to another company.</p>
            </div>
            <div class="w-full mb-7 md:mb-0 md:w-1/4  px-2.5">
                <h3 class="mb-4 leading-5 font-bold text-xl text-greendarkclr">Pro Version For Agencies</h3>
                <p class="mb-2 font-serif text-tgray text-[13px] leading-4">Add value to your services by providing unlimited clients with an unlimited number of employee benefit statements for only $2,999/year.</p>
                <ul class="list-disc text-[#164900] pl-5">
                    <li><a href="{{route('insuranceAgenciesBenefitsSoftware')}}" class="font-serif text-[#164900] inline-block text-[13px] underline underline-offset-1 font-bold">Insurance Agencies</a></li>
                    <li><a href="{{route('hrConsultantsBenefitsSoftware')}}" class="font-serif text-[#164900] inline-block text-[13px] underline underline-offset-1 font-bold">HR Firms</a></li>
                    <li><a href="{{route('benefitsConsultantsSoftware')}}" class="font-serif text-[#164900] inline-block text-[13px] underline underline-offset-1 font-bold">Consultancies</a></li>
                    <li><a href="{{route('accountingFirmsBenefitsSoftware')}}" class="font-serif text-[#164900] inline-block text-[13px] underline underline-offset-1 font-bold">Accounting Firms</a></li>
                </ul>
            </div>
            <div class="w-full md:w-1/4 px-2.5">
                <h3 class="mb-4 leading-5 font-bold text-xl text-greendarkclr">COMPackage For Businesses</h3>
                <p class="mb-2 font-serif text-tgray text-[13px] leading-4">Small businesses can run employee benefit reports for as little as $6.30/employee. Large businesses can run unlimited reports for as little as $1,599/year.</p>
                <ul class="list-disc text-[#164900] pl-5">
                    <li><a href="{{route('smallBusinessBenefitsSoftware')}}" class="font-serif text-[#164900] inline-block text-[13px] underline underline-offset-1 font-bold">Small Businesses</a></li>
                    <li><a href="{{route('largeBusinessBenefitsSoftware')}}" class="font-serif text-[#164900] inline-block text-[13px] underline underline-offset-1 font-bold">Large Businesses</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row flex flex-wrap">
        <div class="w-full md:w-1/3 p-6 bg-graydarkclr md:rounded-bl-lg">
            <h3 class="mb-4 leading-5 font-bold text-xl text-white">Total Compensation<br>Statement Software</h3>
            <p class="mb-2 font-serif text-tgray text-[11px] leading-4">COMPackage software allows any company or agency to easily, securely and inexpensively generate total benefit statements. With over 80 company-paid benefits and perks to include in your reports, COMPackage covers total benefits paid to employees so you can show them what they really earn on top of their annual salary.</p>
            <p class="mb-2 font-serif text-tgray text-[11px] leading-4">COMPackage total compensation statements help businesses clearly communicate to employees their benefit costs such as vacation time, laptop computers, education and entertainment, as well as health care and other standard benefits.</p>
            <p class="mb-5 font-serif text-tgray text-[11px] leading-4">Small businesses can create reports for as little as $8/employee (up to 200 employees) and we offer unlimited reporting for larger companies and professional service agencies for only $2,599/year or a professional version for $2,999/year.</p>
            <a href="{{route('totalCompensationStatements')}}" class="inline-block rounded px-8 py-2.5 leading-4 text-center gradient-whtgry hover:gradient-green hover:text-white text-greendarkclr font-sans font-bold text-lg">Learn More</a>
        </div>
        <div class="w-full md:w-1/3 p-6 bg-greenclr">
            <h3 class="mb-4 leading-5 font-bold text-xl text-white">In The Blog</h3>
            <h4 class="mb-3 leading-5 font-bold text-base text-white">When is the Best Time to Give Employees a Total Benefit Statement?</h4>
            <em class="mb-2 font-serif text-white text-xs">Joe Blattner</em>
            <p class="mb-5 font-serif text-tgray text-[13px] leading-4">If you’re like most business owners or HR Managers, you know that communicating with employees about their salary and benefits is always a touchy subject. It’s best to plan accordingly and ensure that the timing is appropriate. But when is a good time to tell employees what their salary, health benefits, sick time, vacation time, ...</p>
            <a href="http://blog.compackage.com/" target="_blank" class="inline-block rounded px-8 py-2.5 leading-4 text-center gradient-whtgry hover:gradient-green hover:text-white text-greendarkclr font-sans font-bold text-lg">Read More</a>
        </div>
        <div class="w-full md:w-1/3 p-6 bg-greenlightclr relative rounded-br-lg overflow-hidden">
        <h3 class="mb-4 leading-5 font-bold text-xl"><a href="{{route('productReviews')}}" class="text-white hover:underline hover:underline-offset-1">Product Reviews</a></h3>
        
        <ul class="simply-scroll-list" id="teste-scroller">
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">COMPackage is an extremely easy software to use to create total wage/benefit statements. It is visually appealing and provides greater benefit and wage transparency for employees. We have used COMPackage for six or more years and we are happy to recommend the product.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Jodi Ovens</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Business Administrator &amp; HR Manager, Housewright Construction, Newbury, Vermont</p>
                    </li>
                     <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold"><img alt="Brett B" src="{{ asset('images/Brett.webp') }}" class="w-14 h-14 float-left mr-2">Compackage has given my small business a Professional look at a very affordable cost.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Brett B.</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Business Administrator &amp; HR Manager, Housewright Construction, Newbury, Vermont</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold"><img alt="Jessica Schreader" src="{{ asset('images/Jessica-Schreader.png') }}" class="w-14 h-14 float-left mr-2">COMPackage is an awesome program that has exceeded our expectations. The fact that COMPackage is Web-based is terrific because the program is so accessible and easy to use.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Jessica Schreader</p>
                        <p class="font-serif text-tgray text-[10px] px-3">HR, Vance Metal Fabricators, Geneva, NY</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">With COMPackage we have a detailed, big picture of the costs of employment at our company. COMPackage’s cost is a good deal and it is really user friendly.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Stephanie Iden</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Director of Human Resources, FBD Partnership, San Antonio, TX</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold"><img alt="Tiffani Vizza" src="{{ asset('images/Tifanni-Vizza.png') }}" class="w-14 h-14 float-left mr-2">COMPackage demonstrated that fringe benefits add 35% at the lowest paid workers and as high as 50% for some employees. The program certainly met our expectations.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Tiffani Vizza</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Treasurer, Napa Valley Petroleum, American Canyon, CA</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>    
                            <p class="pt-2 text-tgray text-lg font-bold"><img alt="Judy Grier" src="{{ asset('images/Judy-Grier.png') }}" class="w-14 h-14 float-left mr-2">We found the COMPackage program easy to use and it met our expectations.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Judy Grier</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Human Resources Manager, Masco Retail Sales Support, Mooresville, NC</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">We are very happy with COMPackage. It’s an easy system to use and the tech staff is responsive and capable.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Becky Bertolasi</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Administrative Manager, La Monica Beverage, Loves Park, IL</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">We had no way to calculate the true cost of our fringe benefits until we found COMPackage. Their software allows us to show employees that their fringe benefits add up to an additional 42% to 52% to their annual compensation.</p>
                        <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Becky Allen</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Bullard Manufacturing, Cynthiana, KY</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">COMPackage is very good, very easy to use. The TCR gave us a bigger picture, one that we had never seen before.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Bill Melang</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Owner, Ultratech Tool &amp; Design, Fond du Lac, WI</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">COMPackage more than met our expectations and our employees liked the annual report. They saw information that they had never seen before.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Linda Collins</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Payroll Administration, DYWIDAG Systems, Worldwide</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">We like COMPackage because the program is easy to use and the technical staff is accessible and friendly. The program has met our expectations.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Carla Reed</p>
                        <p class="font-serif text-tgray text-[10px] px-3">HR Administrator America’s Promise Alliance, Washington, D.C</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold"><img alt="Carmen Detherage" src="{{ asset('images/Carmen-Detherage.png') }}" class="w-14 h-14 float-left mr-2">COMPackage gives us a much bigger picture of the cost of fringe benefits than we ever had before. It is a very good, easy to use program that exceeded our expectations.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Carmen Detherage</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Linville Management Service, Jacksonville, FL</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/tl-quote.png') }})"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">I wanted to extend my appreciation for all your help as we created these compensation summaries.  You epitomized great customer service, and will be one of the main reasons Riverdale Park returns next year to COMPackage for our next summaries. Well done!</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" style="background-image:url({{ asset('images/br-quote.png') }})"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Anthony Dubosee</p>
                        <p class="font-serif text-tgray text-[10px] px-3">HR Director, Town of Riverdale Park, Riverdale Park, MD</p>
                    </li> 
				</ul>
        </div>
    </div>
</div>
<div class="container mx-auto px-3.5">
    <div class="bg-white p-5 space-y-3">
        <h3 class="mb-4 leading-5 font-bold text-xl text-greendarkclr">A Sampling of Some of Our Many Users...</h3>
        <div class="cmp-logo-section hidden sm:block">
            <div class="row flex flex-wrap gap-6 items-center justify-center">
            <img src="{{ asset('images/Coca_Cola.jpg') }}" alt="Coca Cola">
            <img src="{{ asset('images/Tito-Vodka.jpg') }}" alt="Tito’s Vodka">
            <img src="{{ asset('images/Harley_Devidson.jpg') }}" alt="Harley Davidson">
            <img src="{{ asset('images/BBB.jpg') }}" alt="Better Business Bureau, Boston">
            <img src="{{ asset('images/RotoRooter.jpg') }}" alt="Roto Rooter of Northern Michigan">
            <img src="{{ asset('images/Frank_Lloyd.jpg') }}" alt="Frank Lloyd Wright Foundation">
            </div>
           <div class="row flex flex-wrap gap-6 items-center justify-center">
            <img src="{{ asset('images/MasterClean.jpg') }}" alt="Master Clean">
            <img src="{{ asset('images/Westfield.jpg') }}" alt="Westfield Bank">
            <img src="{{ asset('images/CobbsAllen.jpg') }}" alt="Cobbs Allen">
            <img src="{{ asset('images/Kenneth.jpg') }}" alt="Kenneth Salons">
            </div>
        </div>
        <div class="cmp-logo-section-mob block sm:hidden">
            <div class="row flex flex-wrap gap-6 items-center justify-center">
            <img src="{{ asset('images/Coca_Cola.jpg') }}" alt="Coca Cola">
            <img src="{{ asset('images/Tito-Vodka.jpg') }}" alt="Tito’s Vodka">
            <img src="{{ asset('images/Harley_Devidson.jpg') }}" alt="Harley Davidson">
            <img src="{{ asset('images/BBB.jpg') }}" alt="Better Business Bureau, Boston">
            <img src="{{ asset('images/RotoRooter.jpg') }}" alt="Roto Rooter of Northern Michigan">
            <img src="{{ asset('images/Frank_Lloyd.jpg') }}" alt="Frank Lloyd Wright Foundation">
            <img src="{{ asset('images/MasterClean.jpg') }}" alt="Master Clean">
            <img src="{{ asset('images/Westfield.jpg') }}" alt="Westfield Bank">
            <img src="{{ asset('images/CobbsAllen.jpg') }}" alt="Cobbs Allen">
            <img src="{{ asset('images/Kenneth.jpg') }}" alt="Kenneth Salons">
            </div>
        </div>
    </div>
</div>

@endsection
