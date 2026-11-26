@extends('layouts.public')

@section('content')
    <div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">COMPackage Online</h1>
                    <h2 class="pb-5 mb-5 text-md text-greendarkclr font-bold">Demonstration video</h2>
                    <div class="mb-5">
                        <!--<iframe class="w-full md:h-[420px] h-[300px]"  id="player" type="text/html" frameborder="0" allowfullscreen="1" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="Total Compensation Statements - Creating Total Benefit Reports Video: Compackage Online" src="https://www.youtube.com/embed/sUqTN91w6dY?enablejsapi=1"></iframe> -->
                        <!-- <iframe class="w-full md:h-[420px] h-[300px]"  id="player" type="text/html" frameborder="0" allowfullscreen="1" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="Total Compensation Statements - Creating Total Benefit Reports Video: Compackage Online" src="https://www.youtube.com/embed/61tMePQ30Eo?enablejsapi=1"></iframe> -->
                        <div class="w-full relative border-2 border-solid border-[#16612e]">
                            <div class="w-full relative p-[28.1%]">
                                <iframe class="w-full h-full absolute block top-0 left-0 m-0"  id="player" type="text/html" frameborder="0" allowfullscreen="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="Total Compensation Statements - Creating Total Benefit Reports Video: Compackage Online" src="https://www.youtube.com/embed/61tMePQ30Eo?enablejsapi=1&playlist=61tMePQ30Eo&loop=1&autoplay=0&controls=1&rel=0"></iframe>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="pb-1 text-md text-[#353535] font-bold">Still have a few questions?</h3>
                        <!-- <p class="pb-2 font-serif text-[13px] text-dgray">Email me directly at <a href="mailto:jblattner@compackage.com" class="text-[#164900] underline underline-offset-1">jblattner@compackage.com</a> and me or one of my associates can get back to you shortly. Please share with your inquiry: your number of employees, or whether you are looking for the professional version. Thanks!!</p> -->
                        <ul class="list-disc text-[#164900] pl-5">
                            <li><a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">View Pricing</a></li>
                            <li><a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">View Sample Report</a></li>
                            <li><a href="{{route('purchaseform')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">Purchase</a></li>
                            <li><a href="{{route('benefitSoftwareFaq')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">FAQs</a></li>
                            <li><a href="{{route('contact')}}" class="text-greendarkclr hover:text-lbrwnclr text-[13px] font-serif font-bold">Contact Us - We’re happy to hear from you!</a></li>
                        </ul>
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

