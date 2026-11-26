@extends('layouts.public')

@section('content')
<div class="container h-full mx-auto px-3.5">
        <div class="row flex h-full flex-wrap items-center justify-center">
            <div class="w-full md:w-[60%] lg:w-[70%] pt-20 mt-2">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Digital Delivery of Reports</h1>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Please enter your information below to access your total compensation report..</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">
                        <digital-delivery-report></digital-delivery-report>
                    </p>

                </div>
            </div>
            <!--
            <div class="w-full md:w-[40%] lg:w-[30%] py-5 px-5 lg:pt-20 lg:pb-5 lg:px-8 bg-bgbrwn">
                <public-sidebar pcurrent_route="{{ url()->current() }}"></public-sidebar>
            </div>
-->
        </div>
</div>

<!--<div class="container mx-auto px-3.5">
    <div class="bg-greendarkclr p-5 rounded-b-lg"></div>
</div>-->
@endsection
