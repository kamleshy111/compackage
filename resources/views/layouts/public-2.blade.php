<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if( Route::current()?->uri() == "employee-benefit-resources/11-benefits-to-consider-including-in-your-employee-total-compensation-statements" )
    <meta name="robots" content="noindex, nofollow">
    @endif
    
    <!-- Canonical Tag Link -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if( ! empty( $title ) ) {{ $title }} @else {{ config('app.name', 'Laravel') }} @endif</title>
    <meta name="keywords" content="{{ ! empty ($keywords) ? $keywords : 'total compensation statements, total benefit reports, employee benefit reports, total salary reports, software, COMPackage' }}">

    <meta name="description" content="{{ ! empty ($description) ? $description : 'Show your employees their total benefits with Total Compensation Statements from COMPackage. Take a virtual tour of our benefits software today.' }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/global-custom-user.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/jquery.simplyscroll.js') }}" type="text/javascript" defer></script>
    <script src="https://www.youtube.com/player_api" defer></script>
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- Fonts -->
    <link href="{{ asset('css/fonts.googleapis.com.css') }}" rel="stylesheet">
    <link rel="preload" href="https://www.compackage.com/fonts/ArialMT.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="icon" href="{{ asset('images/favicon.png') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>

        function moveUp() {
            if(jQuery('#compgk-form').length>0){
                jQuery('html,body').animate({
                    scrollTop: jQuery("#compgk-form").offset().top
                }, 1000);
            }
        }
        function showErrorMessage( msg ) {
            jQuery('.comalert-error').css('right','0');
            jQuery('.comalert-error').html(msg);
            setTimeout(function() {
                jQuery('.comalert-error').css('right','-100%');
            }, 1000);
        }
        function showSuccessMessage( msg ) {
            jQuery('.comalert-success').html(msg);
            jQuery('.comalert-success').css('right','0');
            setTimeout(function() {
                jQuery('.comalert-success').css('right','-100%');
            }, 3000);
        }
    </script>
    <style>
        .simply-scroll-clip {
            position: relative;
            overflow: hidden;
            height: 390px;
        }
        .get-report-instructions ul {
            list-style: inside;
        }
        .get-report-instructions {
            font-size: 11px;
        }
        .benefit_sw_faq .faq_question {
			position: relative;
		}	
		.benefit_sw_faq .arrow_accordion_down {
			position: absolute;
			right: -10px;
			top: 5px;
			width: 16px;
		}
		.benefit_sw_faq .accordion_img.open span.arrow_accordion_down {
			transform: rotate(180deg);
			transition: all 500ms;
		}
		.benefit_sw_faq .arrow_accordion_down {
			transition: all 500ms;
		}
		.benefit_sw_faq .accordion_img {
			cursor: pointer;
		}
		.ullist_revert {
			list-style: disc;
			padding: revert;
		}
		.ollist_revert {
			list-style: revert;
			padding: revert;
		}
    </style>
    @yield('styles')

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TTRR5F3');</script>
    <!-- End Google Tag Manager -->

    <!-- WebLeads tracking -->
        <script>
            (function () {
                var e,i=['https://www.fastbase.com/fscript.js','4xzL5WVwJ2','script'],a=document,s=a.createElement(i[2]);
                s.async=!0,s.id=i[1],s.src=i[0],(e=a.getElementsByTagName(i[2])[0]).parentNode.insertBefore(s,e)
            })();
        </script>
    <!-- WebLeads tracking -->

</head>
@if( Route::current()?->uri() == "get-report" )
    <body style="background-image:url('{{ asset('images/common-bg.jpg') }}')" class="h-full bg-cover bg-repeat-x bg-center bg-fixed overflow-x-hidden">
@else
    <body style="background-image:url('{{ asset('images/full-background.jpg') }}')" class="bg-cover bg-repeat-x bg-fixed overflow-x-hidden">
@endif

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TTRR5F3"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="app" class="h-full">

        @if( Route::current()?->uri() == "get-report" )
            <main class="h-full">
        @else
        <div class="comalert-error z-30 fixed max-w-xs w-full bg-red-400 text-white font-bold text-base border-l-4 border-solid border-l-red-600 -right-full top-20 p-2.5 transition-all duration-1000">
            Form Fields is required
        </div>
        <div class="comalert-success z-30 fixed max-w-xs w-full bg-green-400 text-white font-bold text-base border-l-4 border-solid border-l-green-600 -right-full top-20 p-2.5 transition-all duration-1000">
            This is alert
        </div>

        <!-- <div class="cta-header-banner row flex flex-wrap items-center w-full justify-center bg-[#03eb0a]">
            <div class="cta-text font-medium text-2xl py-2 text-[#cd0000]">Our 16th Year Holiday SALE. Buy now and save up to 52%! Use coupon code: <span class="font-bold">HOLIDAY23</span> – Ends this week</div>
        </div> -->
        
        <header>
            <div class="container mx-auto py-7 px-3.5 bgblack">
            <p style="text-align: center;color: #ffffff;font-size: 20px;background: #ff6600;padding: 10px;margin-bottom: 15px;box-shadow: 0px 2px 8px 0px #a3a2a2;"><strong>NEW! Version 3.0</strong> includes Hourly Top Box Scores, Digital Delivery and Illuminative Metrics™ <a href="{{ asset('benefitspdf/New Features Flyer.pdf') }}" class="gradient-green rounded-lg px-4 py-2.5 font-bold text-lg" style="display: inline-block;">Get Details</a></p>
                <div class="row flex flex-wrap -mx-4">
                    <div class="md:w-7/12 w-4/5 px-4">
                        <a href="{{route('home')}}"><img src="{{ asset('images/logo.png') }}" alt="Compackage" /></a>
                    </div>
                    <div class="md:w-5/12 w-1/5	px-4 flex items-center">
                        <div class="md:hidden flex w-full justify-end">
                            <div id="hamburger-menu" class="rounded shadow-xl gradient-brown text-white w-11">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 mx-auto w-9" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </div>
                        </div>
                        <div class="hidden md:block text-greendclr font-serif mr-2.5">
                            <div class="flex text-0">
                                <span class="text-lg">Phone</span>
                                <span class="text-lg text-graydclr px-2">|</span>
                                <a class="text-lg text-greenlightclr" href="tel:833-468-7674">833-468-7674</a>
                            </div>
                        </div>
                        <div class="hidden md:block ">
                            <ul class="flex">
                                <li class="mr-1.5">
                                    <a href="http://www.facebook.com/pages/COMPackage/152802771431628" target="_blank">
                                        <img src="{{ asset('images/facebook.jpg') }}" alt="Like us on Facebook">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/company/compackage/about/" target="_blank">
                                        <img src="{{ asset('images/linkedIn.jpg') }}" alt="Friend us on LinkedIn">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="hidden md:flex w-full px-4 justify-end pt-2">
                        <a href="{{route('login')}}"
                            class="flex items-center justify-center rounded-lg w-96 px-4 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg"><span>Customer
                                Login</span><span class="ml-3.5"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="rounded-full text-greendclr bg-white h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg></span></a>
                    </div>
                </div>
            </div>
            <public-header-nav></public-header-nav>
        </header>
        <main class="pb-10">
        @endif

        @yield('content')

        @if( Route::current()?->uri() == "get-report" )
        </main>

        @else
        </main>
        <footer class="pb-7">
            <div class="container mx-auto px-3.5">
                <div class="row flex flex-wrap -mx-4 items-start">
                    <div class="md:w-[150px] w-full px-4 pb-5 md:pb-5">
                        <a href="{{route('home')}}">
                            <img src="{{ asset('images/footer-logo.png') }}" class="mb-4" alt="Compackage" />
                        </a>
                        <ul class="justify-start flex flex-wrap items-center mb-3">
                            <li>
                                <a href="http://www.facebook.com/pages/COMPackage/152802771431628" target="_blank">
                                    <img src="{{ asset('images/facebook-icon.jpg') }}" alt="Like us on Facebook">
                                </a>
                            </li>
                            <li class="ml-1.5">
                                <a href="https://www.linkedin.com/company/compackage/about/" target="_blank">
                                    <img src="{{ asset('images/linkedin.jpg') }}" alt="Friend us on LinkedIn">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="md:w-[calc(100%_-_150px)] w-full px-4 flex flex-wrap gap-y-6">
                        <div class="sm:w-1/3 w-full">
                            <h3 class="text-greendarkclr text-[13px] font-serif font-bold">COMPackage Corp.</h3>
                            <div class="text-txtclr text-txt font-serif">
                                <span class="block">PO Box 152</span>
                                <span class="block">Presto PA, 15142</span>
                                <span class="block">833-468-7674</span>
                                <span class="block">&copy; Copyright 2024</span>
                            </div>
                        </div>
                        <div class="sm:w-1/3 w-1/2">
                            <ul class="justify-start md:justify-end lg:justify-start flex flex-wrap items-center">
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{route('aboutus')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">About</a>
                                </li>
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{route('stayConnected')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">Connect</a>
                                </li>
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{route('siteMap')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">Site Map</a>
                                </li>
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{route('privacyPolicy')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">Privacy Policy</a>
                                </li>
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{route('termsConditions')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                        <div class="sm:w-1/3 w-1/2">
                            <ul class="justify-start md:justify-end lg:justify-start flex flex-wrap items-center">
                                <li class="pb-1.5 md:pb-0 w-full testing">
                                    <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">View Demo</a>
                                </li>
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">View Pricing</a>
                                </li>
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{ route('purchaseform') }}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">Purchase</a>
                                </li>
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">Sample Report</a>
                                </li>
                                <li class="pb-1.5 md:pb-0 w-full">
                                    <a href="{{route('purchaseform')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">What is COMPackage Software?</a>
                                </li>
                            </ul>
                        </div>
                        <div class="w-full flex flex-wrap">
                            <ul class="flex flex-wrap content-start md:gap-5">
                                <li class="pr-1.5 pb-1.5 md:pr-0 md:pb-0">
                                    <img src="{{ asset('images/logo-godaddy.png') }}" alt="GoDaddy">
                                </li>
                                <li class="pr-1.5 pb-1.5 md:pr-0 md:pb-0">
                                    <a href="https://www.bbb.org/us/pa/presto/profile/computer-software/compackagecom-0141-71041351#bbbonlineclick" target="_blank">
                                        <img src="{{ asset('images/logo-bbb.png') }}" alt="bbb">
                                    </a>
                                </li>
                                <li class="pr-1.5 pb-1.5 md:pr-0 md:pb-0">
                                    <a href="https://www.ypo.org/" target="_blank">
                                        <img src="{{ asset('images/logo-ypo.png') }}" alt="YPO">
                                    </a>
                                </li>
                                <li class="pr-1.5 md:pr-0">
                                    <img src="{{ asset('images/logo-visa-mastercard-amex.png') }}" alt="Visa Mastercard Amex">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        @endif

    </div>
    @yield('scripts')
</body>

</html>
