<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if( Route::current()?->uri() == "employee-benefit-resources/11-benefits-to-consider-including-in-your-employee-total-compensation-statements" && "homebackup" )
    <meta name="robots" content="noindex, nofollow">
    @endif

    <!-- Canonical Tag Link -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if( ! empty( $title ) ) {{ $title }} @else {{ config('app.name', 'Laravel') }} @endif</title>
    <meta name="keywords"
        content="{{ ! empty ($keywords) ? $keywords : 'total compensation statements, total benefit reports, employee benefit reports, total salary reports, software, COMPackage' }}">

    <meta name="description"
        content="{{ ! empty ($description) ? $description : 'Show your employees their total benefits with Total Compensation Statements from COMPackage. Take a virtual tour of our benefits software today.' }}">
    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jQuery.js') }}" defer></script>
    <script src="{{ asset('js/global-custom-user.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/jquery.simplyscroll.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" type="text/javascript" defer></script>
    <!-- <script src="https://www.youtube.com/player_api" defer></script> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- Fonts -->
    <link href="{{ asset('css/fonts.googleapis.com.css') }}" rel="stylesheet">
    <link rel="preload" href="https://www.compackage.com/fonts/ArialMT.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="icon" href="{{ asset('images/favicon.png') }}">


    <!-- Styles -->
    <link media="all" href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        function moveUp() {
            if (jQuery('#compgk-form').length > 0) {
                jQuery('html,body').animate({
                    scrollTop: jQuery("#compgk-form").offset().top
                }, 1000);
            }
        }

        function showErrorMessage(msg) {
            jQuery('.comalert-error').css('right', '0');
            jQuery('.comalert-error').html(msg);
            setTimeout(function() {
                jQuery('.comalert-error').css('right', '-100%');
            }, 1000);
        }

        function showSuccessMessage(msg) {
            jQuery('.comalert-success').html(msg);
            jQuery('.comalert-success').css('right', '0');
            setTimeout(function() {
                jQuery('.comalert-success').css('right', '-100%');
            }, 3000);
        }
    </script>
    <style>
        .faq-item--marker:before {
            content: '';
            width: 20px;
            height: 20px;
            position: absolute;
            top: 0%;
            left: -45px;
            transform: translate(0%, 30%) rotate(-45deg);
            background: #000000;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0) 50%, rgba(134, 190, 55, 1) 50%);
        }

        .cp-demoVideo-group:before {
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            display: block;
            background: #000000;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.5) 0%, rgba(255, 255, 255, 0) 15%, rgba(255, 255, 255, 0) 85%, rgba(0, 0, 0, 0.5) 100%);
        }

        .owl-item .cp-brands--item {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cp-brands.owl-carousel.owl-theme {
            overflow: hidden;
        }

        .owl-item {
            display: inline-block;
            vertical-align: middle;
        }

        .line-marker:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;
            background-image: url('https://www.compackage.com/images/yellow-line-mark.png');
            background-size: contain;
            background-position: bottom center;
            background-repeat: no-repeat
        }

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
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TTRR5F3');
    </script>
    <!-- End Google Tag Manager -->

    @if(empty($disableWebPageSchema))
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "url": "{{ url()->current() }}",
            "name": "{{ $title ?? 'ComPackage' }}",
            "description": "{{ $description ?? 'ComPackage is a total compensation statement software to show the true value of employee benefits.' }}",
            "inLanguage": "en"
        }
    </script>
    @endif
    @stack('head')

</head>
@if( Route::current()?->uri() == "get-report" )

<body style="background-image:url('{{ asset('images/common-bg.jpg') }}')"
    class="h-full bg-cover bg-repeat-x bg-center bg-fixed overflow-x-hidden">
    @else

    <body class="overflow-x-hidden">
        @endif

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TTRR5F3" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div id="app" class="h-full">

            @if( Route::current()?->uri() == "get-report" )
            <main class="h-full">
                @else
                <div
                    class="comalert-error z-30 fixed max-w-xs w-full bg-red-400 text-white font-bold text-base border-l-4 border-solid border-l-red-600 -right-full top-20 p-2.5 transition-all duration-1000">
                    Form Fields is required
                </div>
                <div
                    class="comalert-success z-30 fixed max-w-xs w-full bg-green-400 text-white font-bold text-base border-l-4 border-solid border-l-green-600 -right-full top-20 p-2.5 transition-all duration-1000">
                    This is alert
                </div>

                <!-- <div class="cta-header-banner row flex flex-wrap items-center w-full justify-center bg-[#c60f0f]">
                    <div class="cta-text font-medium text-2xl py-2 text-white">Our 18th Year Holiday SALE. Buy now and save up to 52%! Use coupon code: <span class="font-bold">HOLIDAY25</span></div>
                </div> -->

                <header class="py-5">
                    <div class="container mx-auto px-4">
                        <div class="flex flex-wrap items-center justify-between">
                            <div class="sm:w-1/3 w-full sm:order-none order-3 sm:mt-0 mt-3">
                                <a href="/">
                                    <img class="mx-auto sm:mx-0" src="{{ asset('images/logo.webp') }}" alt="" />
                                </a>
                            </div>
                            <div class="sm:w-1/3 w-1/2 sm:text-center text-left"><a href="tel:833-468-7674"
                                    class="text-greenDarkMoss sm:text-3xl text-xl font-semibold hover:text-greenlightclr">833-468-7674</a>
                            </div>
                            <div class="sm:w-1/4 w-1/2 text-right"><a href="/login"
                                    class="text-greenDarkMoss text-xl font-bold text-right hover:text-greenlightclr underline">Client
                                    Login</a>
                            </div>
                        </div>
                    </div>
                </header>
                <main class="pb-4">
                    @endif

                    @yield('content')

                    @if( Route::current()?->uri() == "get-report" )
                </main>

                @else
            </main>
            <footer class="py-4">
                <div class="container mx-auto px-4">
                    <div class="footer-line">
                        <h3 class="w-full text-3xl font-bold text-center mb-10 text-greenDarkMoss italic">
                            The #1 self-service total compensation statement software since 2007
                        </h3>
                    </div>
                    <div class="flex flex-wrap md:flex-row flex-col items-start">
                        <div class="md:w-1/3 w-full">
                            <img src="{{ asset('images/footer-logo.webp') }}" class="w-[90px]" alt="Footer Logo" />
                            <div class="w-full pt-2 flex flex-wrap md:justify-center justify-start">
                                <div>
                                    <h3 class="text-lg font-serif font-medium italic">COMPackage Corp.</h3>
                                    <div class="text-lg italic font-serif">
                                        <span class="block font-medium">P.O. Box 90062</span>
                                        <span class="block font-medium">Henderson, NV 89009</span>
                                        <span class="block font-medium">833-468-7674</span>
                                        <span class="block mt-8 font-normal text-[14px]">© <?php echo date('Y'); ?> COMPackage Corp.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3 w-full md:pt-[85px] pt-[30px] relative">
                            <div class="flex flex-wrap md:flex-row flex-col items-start justify-between md:gap-4 gap-2">
                                <div class="md:w-2/5 w-full">
                                    <ul class="flex flex-wrap flex-col gap-2">
                                        <li class="">
                                            <span class="cp-has-sub-menu text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap flex-row gap-4">
                                                Total Benefit Statements
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </span>
                                            <div class="hidden cp-sub-menu-footer bg-greenTea w-full h-full p-4 absolute top-0 left-0">
                                                <span class="cp-close-sub-item text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap gap-2 flex-row w-20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                                    </svg>
                                                    Back
                                                </span>
                                                <ul class="flex flex-wrap md:flex-row flex-col gap-y-3 mt-5">
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('totalCompensationStatements')}}">Total Benefit Statements</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('insuranceAgenciesBenefitsSoftware')}}">For Insurance Agencies</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('hrConsultantsBenefitsSoftware')}}">For HR Consultants</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('benefitsConsultantsSoftware')}}">For Benefits Consultants</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('accountingFirmsBenefitsSoftware')}}">For Accounting Firms</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('largeBusinessBenefitsSoftware')}}">For Large Businesses</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('smallBusinessBenefitsSoftware')}}">For Small Businesses</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="{{route('compensationStatementPricing')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Pricing</a>
                                        </li>
                                        <li>
                                            <span class="cp-has-sub-menu text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap flex-row gap-4">
                                                Why COMPackage?
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </span>
                                            <div class="hidden cp-sub-menu-footer bg-greenTea w-full h-full p-4 absolute top-0 left-0">
                                                <span class="cp-close-sub-item text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap gap-2 flex-row w-20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                                    </svg>
                                                    Back
                                                </span>
                                                <ul class="flex flex-wrap md:flex-row flex-col gap-y-3 mt-5">
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('whyCompackage')}}">Why COMPackage?</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('hiddenEmployeeCompensationPerks')}}">Cost of Hidden Perks</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('employeeBenefitsCost')}}">Cost of Employee Benefits</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('reducingEmployeeTurnover')}}">Reducing Employee Turnover</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('productReviews')}}">Read Client Testimonials</a></li>
                                                </ul>
                                            </div>
                                        <li>
                                            <span class="cp-has-sub-menu text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap flex-row gap-4">
                                                Learn More
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </span>
                                            <div class="hidden cp-sub-menu-footer bg-greenTea w-full h-full p-4 absolute top-0 left-0">
                                                <span class="cp-close-sub-item text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap gap-2 flex-row w-20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                                    </svg>
                                                    Back
                                                </span>
                                                <ul class="flex flex-wrap md:flex-row flex-col gap-y-3 mt-5">
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('employeeTotalCompensationStatements')}}">Learn More</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('totalCompensationDemo')}}">View a Free Demo</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('compensationStatementPricing')}}">View Pricing</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('benefitSoftwareFaq')}}">FAQ</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('sampleTotalCompensationReport')}}">View a Total Compensation Statement</a></li>
                                                    <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('benefitStatementGlossary')}}">Benefit Statement Glossary</a></li>
                                                    <li class="w-full">
                                                        <span class="cp-has-sub-menu text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-row gap-4">Practical uses of Employee Benefit Reports
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                            </svg>
                                                        </span>
                                                        <div class="hidden cp-sub-menu-footer bg-greenTea w-full h-full p-4 absolute top-0 left-0">
                                                            <span class="cp-close-sub-item text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap gap-2 flex-row w-20">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                                                </svg>
                                                                Back
                                                            </span>
                                                            <ul class="flex flex-wrap flex-col gap-y-3 mt-5">
                                                                <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('employeeYearEndReports')}}">Year End Reports</a></li>
                                                                <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('employeePerformanceReviews')}}">Employee Performance Reviews</a></li>
                                                                <li class="md:basis-1/2 basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('employeeRecruitment')}}">Employee Recruitment</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="cp-has-sub-menu text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap flex-row gap-4">
                                                About
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </span>
                                            <div class="hidden cp-sub-menu-footer bg-greenTea w-full h-full p-4 absolute top-0 left-0">
                                                <span class="cp-close-sub-item text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr cursor-pointer flex flex-wrap gap-2 flex-row w-20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                                    </svg>
                                                    Back
                                                </span>
                                                <ul class="flex flex-wrap flex-col gap-y-3 mt-5">
                                                    <li class="basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('aboutus')}}">About Us</a></li>
                                                    <li class="basis-1"><a class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr" href="{{route('referaFriend')}}">Tell an Associate about COMPackage</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="{{route('blog')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Blog</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="md:w-1/4 w-full">
                                    <ul class="flex flex-wrap flex-col gap-2">
                                        <li><a href="{{route('purchaseform')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Purchase</a>
                                        </li>
                                        <li><a href="{{route('contact')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Contact
                                                Us</a>
                                        </li>
                                        <li><a href="{{route('totalCompensationDemo')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">View
                                                Demo</a>
                                        </li>
                                        <li><a href="{{route('stayConnected')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Connect</a>
                                        </li>
                                        <li><a href="{{route('sampleTotalCompensationReport')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Sample
                                                Report</a>
                                        </li>
                                        <li><a href="{{route('compensationStatementPricing')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">View
                                                Pricing</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="md:w-1/4 w-full">
                                    <ul class="flex flex-wrap flex-col gap-2">
                                        <li><a href="{{route('purchaseform')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Purchase</a>
                                        </li>
                                        <li><a href="{{route('siteMap')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Site
                                                Map</a>
                                        </li>
                                        <li><a href="https://www.compackage.com/feeds" class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Resource Hub</a></li>
                                        <li><a href="{{route('privacyPolicy')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Privacy</a>
                                        </li>
                                        <li><a href="{{route('termsConditions')}}"
                                                class="text-greenDarkMoss text-lg font-serif font-medium hover:text-greenlightclr">Terms
                                                | Conditions</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full flex flex-wrap md:flex-row flex-col items-start justify-between mt-10 mb-4 gap-y-4">
                            <div class="md:w-1/3 w-full">
                                <ul class="flex">
                                    <li class="mr-1.5"><a
                                            href="http://www.facebook.com/pages/COMPackage/152802771431628"
                                            target="_blank"><img src="{{ asset('images/Facebook-Icon.webp') }}"
                                                alt="Like us on Facebook"></a></li>
                                    <li><a href="https://www.linkedin.com/company/compackage/about/"
                                            target="_blank"><img src="{{ asset('images/Linkedin-Icon.webp') }}"
                                                alt="Friend us on LinkedIn"></a></li>
                                </ul>
                            </div>
                            <div class="md:w-2/3 w-full">
                                <div class="w-full">
                                    <ul
                                        class="justify-start md:justify-end flex flex-wrap md:flex-nowrap items-center md:space-x-1.5">
                                        <li class="pr-1.5 pb-1.5 md:pr-0 md:pb-0"><img
                                                src="{{ asset('images/logo-godaddy.png') }}" alt="GoDaddy"></li>
                                        <li class="pr-1.5 pb-1.5 md:pr-0 md:pb-0">
                                            <a href="https://www.bbb.org/us/pa/presto/profile/computer-software/compackagecom-0141-71041351#bbbonlineclick"
                                                target="_blank">
                                                <img src="{{ asset('images/logo-bbb.png') }}" alt="bbb">
                                            </a>
                                        </li>
                                        <li class="pr-1.5 pb-1.5 md:pr-0 md:pb-0">
                                            <a href="https://www.ypo.org/" target="_blank">
                                                <img src="{{ asset('images/logo-ypo.png') }}" alt="YPO">
                                            </a>
                                        </li>
                                        <li class="pr-1.5 md:pr-0"><img
                                                src="{{ asset('images/logo-visa-mastercard-amex.webp') }}"
                                                alt="Visa Mastercard Amex"></li>
                                    </ul>
                                </div>
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