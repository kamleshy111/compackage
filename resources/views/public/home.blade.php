    @extends('layouts.publichome')
    @section('content')
    <section class="bg-greenMoss pt-16 md:pb-0 pb-16">
        <div class="container mx-auto px-4 text-center flex flex-col">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-serif"> Show employees their <span
                    class="font-extrabold line-marker relative pb-6 inline-block">TOTAL</span> compensation package.
            </h2>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"> REDUCE TURNOVER - BOOST RETENTION </h1>
            <p class="text-xl md:text-2xl text-white font-serif"> For companies with 5-5000 employees </p>
            <p class="text-xl md:text-2xl text-white italic font-serif"> (and those who serve companies with 5-5000
                employees) </p>

            <div class="flex flex-col md:flex-row justify-between gap-6 mt-8">
                <div class="items-start w-auto md:w-1/4">
                    <a href="{{route('totalCompensationDemo')}}"
                        class="w-auto md:w-1/3 mx-auto md:w-auto rounded px-4 py-3 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg inline-block flex flex-wrap justify-between items-center gap-6">
                        <span>View Demo</span>
                        <span class="bg-white rounded-full w-5 h-5 flex flex-wrap items-center justify-center">
                            <svg xmlns="https:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="" class="stroke-greenDarkMoss w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="items-center md:w-2/3 w-full md:-mb-32 mb-0">
                    <div class="w-full mx-auto">
                        <iframe class="w-full aspect-video rounded-md shadow-lg" src="https://www.youtube.com/embed/98xw2GyQWyo" title="Embedded video" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="items-end md:w-1/4 w-full">
                    <a href="/total-compensation-statements/software-purchase"
                        class="w-auto md:w-1/3 mx-auto md:w-auto rounded px-4 py-3 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg inline-block flex flex-wrap justify-between items-center gap-6">
                        <span>Purchase Now</span>
                        <span class="bg-white rounded-full w-5 h-5 flex flex-wrap items-center justify-center">
                            <svg xmlns="https:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="" class="stroke-greenDarkMoss w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </a>
                </div>    
            </div>
        </div>
    </section>
    <!-- {{route('totalCompensationDemo')}} -->
    <!-- Brand Logos -->
    <section class="py-24 md:mt-32 mt-0 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12">
                <div class="cp-brands">
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/Frank_Lloyd.jpg') }}" alt="Frank Lloyd Wright Foundation">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/RotoRooter.jpg') }}" alt="Roto Rooter of Northern Michigan">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/Coca_Cola.jpg') }}" alt="Coca Cola">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/Tito-Vodka.jpg') }}" alt="Tito’s Vodka">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/Harley_Devidson.jpg') }}" alt="Harley Davidson">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/BBB.jpg') }}" alt="Better Business Bureau, Boston">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/MasterClean.jpg') }}" alt="Master Clean">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/Westfield.jpg') }}" alt="Westfield Bank">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/CobbsAllen.jpg') }}" alt="Cobbs Allen">
                    </div>
                    <div class="cp-brands--item">
                        <img src="{{ asset('images/Kenneth.jpg') }}" alt="Kenneth Salons">
                    </div>
                </div>
            </div>
            <p class="text-center mt-10 text-lg font-serif"> (Some trusted brands who trust COMPackage) </p>
        </div>
    </section>

    <!-- Sample Report Section -->
    <section class="py-9 bg-greenPaleSage border-b-6 border-greenForest">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-greenDarkMoss">Check Out a Sample Report</h2>
            <div class="flex flex-col md:flex-row justify-between gap-8">
                <div class="w-full md:w-3/4">
                    <div class="flex flex-wrap justify-start">
                        <img src="{{ asset('images/Com-Banner-1.webp') }}" class="mb-8" alt="">
                        <a href="{{route('sampleTotalCompensationReport')}}"
                            class="w-auto md:w-1/3 mx-auto md:w-auto rounded px-4 py-3 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg inline-block flex flex-wrap justify-between items-center gap-6">
                            <span>View Report</span>
                            <span class="bg-white rounded-full w-5 h-5 flex flex-wrap items-center justify-center">
                                <svg xmlns="https:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                    stroke="" class="stroke-greenDarkMoss w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-1/4">
                    <img src="{{ asset('images/Com-Banner-2.webp') }}" class="mb-8 mx-auto" alt="">
                    <p class="text-3xl text-center text-greenDarkMoss font-serif"> Optional hourly report included </p>
                </div>
            </div>
    </section>


    <!-- Articles to help you Understand Section -->
    <section class="py-16 bg-greenTea">
        <div class="container mx-auto px-4 max-w-[700px]">
            <h2 class="text-3xl font-bold text-center mb-8 text-greenDarkMoss">Articles to help you understand the true value of total compensation statements</h2>
            <ul class="flex flex-col gap-2 md:gap-4 w-full max-w-[600px] mx-auto">
                <li><a href="/why-do-employees-feel-underpaid-even-when-theyre-not" class="inline-block w-full text-center bg-white text-[18px] hover:bg-greenDarkMoss hover:text-white border rounded-md border-solid border-[#b1b1b1] p-4 shadow-xl">Why Do Employees Feel Underpaid Even When They’re Not?</a></li>
                <li><a href="/how-can-companies-improve-retention-without-increasing-salaries" class="inline-block w-full text-center bg-white text-[18px] hover:bg-greenDarkMoss hover:text-white border rounded-md border-solid border-[#b1b1b1] p-4 shadow-xl">How Can Companies Improve Retention Without Increasing Salaries?</a></li>
                <li><a href="/are-total-compensation-statements-worth-it-for-small-businesses" class="inline-block w-full text-center bg-white text-[18px] hover:bg-greenDarkMoss hover:text-white border rounded-md border-solid border-[#b1b1b1] p-4 shadow-xl">Are Total Compensation Statements Worth It for Small Businesses?</a></li>
                <li><a href="/how-total-compensation-statements-improve-employee-retention" class="inline-block w-full text-center bg-white text-[18px] hover:bg-greenDarkMoss hover:text-white border rounded-md border-solid border-[#b1b1b1] p-4 shadow-xl">How Total Compensation Statements Improve Employee Retention?</a></li>
            </ul>
        </div>
    </section>


    <!-- Pricing Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-greenDarkMoss">Pricing</h2>
            <div class="flex flex-wrap justify-center gap-2 md:gap-6">
                <div class="p-6 sm:min-w-[280px] min-w-[300px]">
                    <div class="relative overflow-x-auto md:overflow-visible" id="PriceList">
                        <table class="border border-black w-full text-sm text-left text-black">
                            <thead class="text-xs text-white uppercase bg-greendarkclr">
                                <tr>
                                    <th scope="col" class="px-2 py-3">Report Packages</th>
                                    <th scope="col" class="px-2 py-3 text-center">1 Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">1 to 15</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$299</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">16 to 25</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$399</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">26 to 35</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$499</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">36 to 50</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$699</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-6 sm:min-w-[280px] min-w-[300px]">
                    <div class="relative overflow-x-auto md:overflow-visible" id="PriceList">
                        <table class="border border-black w-full text-sm text-left text-black">
                            <thead class="text-xs text-white uppercase bg-greendarkclr">
                                <tr>
                                    <th scope="col" class="px-2 py-3">Report Packages</th>
                                    <th scope="col" class="px-2 py-3 text-center">1 Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">51 to 75</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$999</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">76 to 100</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$1199</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">101 to 150</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$1699</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">151 to 200</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$2099</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-6 sm:min-w-[280px] min-w-[300px]">
                    <div class="relative overflow-x-auto md:overflow-visible" id="PriceList">
                        <table class="border border-black w-full text-sm text-left text-black">
                            <thead class="text-xs text-white uppercase bg-greendarkclr">
                                <tr>
                                    <th scope="col" class="px-2 py-3">Report Packages</th>
                                    <th scope="col" class="px-2 py-3 text-center">1 Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">Unlimited</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$2599</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-black odd:bg-white even:bg-lghtgreen">
                                    <td scope="row" class="px-2 py-2 font-serif">Professional</td>
                                    <td scope="row" class="relative text-center px-2 py-2 font-serif"><span>$2999</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-8">
                <a href="{{route('compensationStatementPricing')}}"
                    class="w-auto md:w-1/3 mx-auto md:w-auto rounded px-4 py-3 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg inline-block flex flex-wrap justify-between items-center gap-6">
                    <span>View Pricing</span>
                    <span class="bg-white rounded-full w-5 h-5 flex flex-wrap items-center justify-center">
                        <svg xmlns="https:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="" class="stroke-greenDarkMoss w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Video Demo Section -->
    <section class="py-9 bg-lightGray border-b-6 border-greenForest">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-greenDarkMoss">Watch how COMPackage works and how easy
                it is to use.</h2>
            <div class="max-w-3xl mx-auto">
                <div class="relative">
                    <a class="cp-demoVideo-group" href="{{route('totalCompensationDemo')}}">
                        <img src="{{ asset('images/Video.webp') }}" alt="" />
                        <img src="{{ asset('images/Play-Icon.webp') }}"
                            class="absolute top-[50%] left-[50%] -translate-y-2/4 -translate-x-2/4 sm:w-auto w-[60px]"
                            alt="" />
                    </a>
                </div>
            </div>
            <div class="flex justify-center mt-8">
                <a href="{{route('totalCompensationDemo')}}"
                    class="w-auto md:w-1/3 mx-auto md:w-auto rounded px-4 py-3 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg inline-block flex flex-wrap justify-between items-center gap-6">
                    <span>View Demo</span>
                    <span class="bg-white rounded-full w-5 h-5 flex flex-wrap items-center justify-center">
                        <svg xmlns="https:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="" class="stroke-greenDarkMoss w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Guarantee Section -->
    <section class="py-14 bg-background">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-8 text-greenDarkMoss">No-Risk Purchasing! Satisfaction Guaranteed!</h2>
            <div class="flex justify-center mb-8">
                <a href="{{route('30day')}}"
                    class="rounded-full gradient-green hover:gradient-lgreen flex flex-wrap justify-center flex-col px-5 py-6">
                    <span class="text-2xl font-bold text-white">30 DAY</span>
                    <span class="text-2xl font-bold text-white">MONEY BACK</span>
                    <span class="text-2xl font-bold text-white">GUARANTEE</span>
                    <span class="text-xl font-semibold text-white ">Learn More</span>
                </a>
            </div>
            <div class="flex justify-center mt-8">
                <a href="/total-compensation-statements/software-purchase"
                    class="w-auto md:w-1/3 mx-auto md:w-auto rounded px-4 py-3 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg inline-block flex flex-wrap justify-between items-center gap-6">
                    <span>Purchase Now</span>
                    <span class="bg-white rounded-full w-5 h-5 flex flex-wrap items-center justify-center">
                        <svg xmlns="https:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="" class="stroke-greenDarkMoss w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- FAQs Section -->
    <!-- <section class="py-12 bg-greenTea border-b-6 border-greenForest"> -->
    <section class="py-12 bg-greenTea">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10 text-greenDarkMoss">FAQs</h2>
            <div class="faqu-group flex flex-wrap flex-col gap-6 mx-auto w-full max-w-2xl">
                <div class="faq-item sm:pl-0 pl-8">
                    <p
                        class="font-serif text-greenDarkMoss text-2xl italic cursor-pointer relative faq-item--marker faq-item--question">
                        How easy is this to set up?
                    </p>
                    <div class="faq-item--answer text-lg text-black mt-2 hidden">
                        <p>You start by simply choosing your benefits from a list, or creating your own. You then click
                            a
                            button which generates a spreadsheet you can download that has all your benefits in it. The
                            hardest part for most clients is simply the gathering of the data to load into the
                            spreadsheet.
                            Once you do, you simply upload it and generate reports. It’s that easy. And if you get
                            stuck, we
                            are here to help you via email, phone or Zoom at no extra charge.</p>
                    </div>
                </div>
                <div class="faq-item sm:pl-0 pl-8">
                    <p
                        class="font-serif text-greenDarkMoss text-2xl italic cursor-pointer relative faq-item--marker faq-item--question">
                        What support is included?
                    </p>
                    <div class="faq-item--answer text-lg text-black mt-2 hidden">
                        <p>At any point, any client can email, phone or Zoom and get expert support. You can even send
                            us
                            your data file and we’ll find any errors. We’re pretty proud of this and don’t know any
                            other
                            company that provides this kind of service without charging for it.</p>
                    </div>
                </div>
                <div class="faq-item sm:pl-0 pl-8">
                    <p
                        class="font-serif text-greenDarkMoss text-2xl italic cursor-pointer relative faq-item--marker faq-item--question">
                        How does COMPackage protect my data?
                    </p>
                    <div class="faq-item--answer text-lg text-black mt-2 hidden">
                        <p>COMPackage employs industry best practices to maintain the security of the platform and all
                            data.</p>
                        <p>The security of your data is very important to us. Of course, no method of transmission over
                            the Internet, or method of electronic storage is 100% secure. While we strive to use
                            commercially acceptable means to protect your personal data, we cannot guarantee its
                            absolute security.
                            Here are the steps we take to protect your data.</p>
                        <p>Sensitive data, including credit card information and passwords, are encrypted. Credit card
                            data is encrypted and securely held by <a class="underline"
                                href="https://stripe.com/">Stripe</a>. Stripe is
                            the second largest online payment
                            processing tool for internet businesses. COMPackage does not store credit card data.
                            All data is behind a firewall.</p>
                        <p>The software used to build COMPackage (<a class="underline"
                                href="https://laravel.com/">Laravel</a>), has many
                            security features built into it
                            which we employ.</p>
                        <ul class="list-disc my-3 flex flex-wrap flex-col gap-2">
                            <li>CSRF Protection: Laravel provides built-in Cross-Site Request Forgery (CSRF) protection
                                through tokens. This helps prevent malicious actions from being executed.</li>
                            <li>Input Validation: Laravel offers various methods for validating user input, making it
                                easier to prevent common vulnerabilities like SQL injection and cross-site scripting
                                (XSS) attacks.</li>
                            <li>Authentication and Authorization: Laravel's authentication and authorization mechanisms
                                are robust and easy to implement. We use features like secure password hashing, user
                                roles, and policies for controlling access to resources.</li>
                            <li>Secure Sessions: Laravel ensures secure session handling and management, using
                                industry-standard best practices to prevent session-related vulnerabilities.</li>
                            <li>Guarding Against Mass Assignment: Laravel's Eloquent ORM includes built-in mechanisms to
                                prevent mass assignment vulnerabilities by allowing you to specify which attributes can
                                be mass assigned and which cannot.</li>
                            <li>Password Hashing: Laravel uses the bcrypt hashing algorithm to securely hash passwords.
                                It also provides a simple and consistent way to manage password hashing and
                                verification.</li>
                            <li>Encryption: Laravel offers straightforward encryption and decryption methods, helping
                                developers secure sensitive data in transit or at rest.</li>
                        </ul>
                        <p>Our hosting company is <a class="underline" href="https://www.cloudways.com/">Cloudways</a>,
                            which uses
                            state-of-the-art security features including
                            enterprise-grade mitigation of DDoS attacks, secure Web Application Firewall (WAF) analyzes
                            millions of sites and 32 million requests per second to intelligently identify block
                            attackers and emerging threats. Cloudways security measures include: Firewalls, Login
                            Security, Bot Protection, Database Security, Application Isolation, SSL Certificates, User
                            Role Management, Operating System’s Security, Two-Factor Authentication, End-to-End
                            Encryption, and Suspicious Device Login Control. For more information,
                            visit <a class="underline"
                                href="https://www.cloudways.com/en/managed-security.php">https://www.cloudways.com/en/managed-security.php</a>.
                        </p>
                    </div>
                </div>
                <div class="faq-item sm:pl-0 pl-8">
                    <p
                        class="font-serif text-greenDarkMoss text-2xl italic cursor-pointer relative faq-item--marker faq-item--question">
                        How does COMPackage help with employee retention and morale?
                    </p>
                    <div class="faq-item--answer text-lg text-black mt-2 hidden">
                        <p>COMPackage helps improve employee retention and morale by showing employees the true value of
                            their total compensation - not just their paycheck. Most employees underestimate what their
                            employer invests in them, often by tens of thousands of dollars per year. When they see a
                            clear,
                            professional report that includes all of the benefits, perks, and employer-paid taxes that
                            they NEVER previously saw, they feel more
                            appreciated and less likely to look elsewhere. By making hidden compensation visible,
                            COMPackage
                            helps you build trust, loyalty, and pride. Employees understand that their organization
                            values
                            them beyond base pay - which boosts morale and engagement. For HR and management, it’s a
                            simple,
                            powerful tool to improve communication, strengthen culture, and retain top talent.</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-8">
                <a href="{{route('benefitSoftwareFaq')}}"
                    class="w-auto md:w-1/3 mx-auto md:w-auto rounded px-4 py-3 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg inline-block flex flex-wrap justify-between items-center gap-6">
                    <span>View All FAQs</span>
                    <span class="bg-white rounded-full w-5 h-5 flex flex-wrap items-center justify-center">
                        <svg xmlns="https:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="" class="stroke-greenDarkMoss w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-12 bg-white border-b-6 border-greenForest">
        <div class="container mx-auto px-4 mb-6">
            <h2 class="text-3xl font-bold text-center mb-6 text-greenDarkMoss">Sign Up for Our Newsletter.</h2>
            <p class="text-xl text-center text-black font-serif"> Thoughtful Ideas for Employers and HR Leaders </p>
            <p class="text-xl text-center text-black font-serif"> Join the COMPackage newsletter for smart, practical articles on compensation, retention, recruitment, and workforce management. </p>
        </div>
        <div class="w-100 max-w-lg mx-auto px-4">
            <div class="p-6 bg-greenPaleSage rounded-lg">
                <div id="mc_embed_shell">
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css">
                    <div id="mc_embed_signup">
                        <form action="https://compackage.us17.list-manage.com/subscribe/post?u=d88d3be38b92862af326bc240&amp;id=151310af6e&amp;f_id=0068d2e3f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" style="margin: 0 !important;">
                            <div id="mc_embed_signup_scroll">
                                <div class="mc-field-group">
                                    <label for="mce-EMAIL" style="line-height: normal; color: #000;">Email Address <span class="asterisk">*</span></label>
                                    <input style="padding: 4px 0;" type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value="">
                                </div>
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display: none;"></div>
                                    <div class="response" id="mce-success-response" style="display: none;"></div>
                                </div>
                                <div aria-hidden="true" style="position: absolute; left: -5000px;"><input type="text" name="b_d88d3be38b92862af326bc240_151310af6e" tabindex="-1" value=""></div>
                                <div class="clear"><input style='background: #a1d167; background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ExZDE2NyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3NWE1M2IiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: linear-gradient(to bottom, #a1d167 0%, #75a53b 100%); color: #fff; font-family: "Roboto Condensed"; font-size: 18px; font-weight: 800;' type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="Subscribe"></div>
                            </div>
                        </form>
                    </div>
                    <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
                    <script type="text/javascript">
                        (function($) {
                            window.fnames = new Array();
                            window.ftypes = new Array();
                            fnames[0] = 'EMAIL';
                            ftypes[0] = 'email';
                            fnames[1] = 'FNAME';
                            ftypes[1] = 'text';
                            fnames[2] = 'LNAME';
                            ftypes[2] = 'text';
                            fnames[3] = 'BIRTHDAY';
                            ftypes[3] = 'birthday';
                            fnames[4] = 'MMERGE4';
                            ftypes[4] = 'text';
                            fnames[5] = 'MMERGE5';
                            ftypes[5] = 'text';
                            fnames[6] = 'MMERGE6';
                            ftypes[6] = 'text';
                            fnames[7] = 'MMERGE7';
                            ftypes[7] = 'text';
                            fnames[8] = 'MMERGE8';
                            ftypes[8] = 'text';
                            fnames[9] = 'MMERGE9';
                            ftypes[9] = 'text';
                            fnames[10] = 'MMERGE10';
                            ftypes[10] = 'text';
                            fnames[11] = 'MMERGE11';
                            ftypes[11] = 'text';
                            fnames[12] = 'MMERGE12';
                            ftypes[12] = 'text';
                        }(jQuery));
                        var $mcj = jQuery.noConflict(true);
                    </script>
                </div>
            </div>
        </div>
    </section>

    @endsection