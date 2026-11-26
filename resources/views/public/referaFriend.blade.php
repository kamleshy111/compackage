@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
        <div class="w-full md:w-[60%] lg:w-[62%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="mb-5 text-3xl text-greendarkclr font-bold">Refer a Friend to COMPackage Employee Compensation Statement Software</h1>
                    <h2 class="pb-5 text-xl text-greendarkclr font-bold leading-5">Want to tell your friends about COMPackage, the total employee compensation statement software? Well don't let us stand in your way! Use this handy tool below. Your support helps us improve our employee compensation statement software and provide even better service for all our clients.</h2>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Thank you, we really appreciate the referral!</p>
                    <img src="{{ asset('images/joesig.gif') }}" />
                    <p class="mt-3 pb-3 font-serif text-[13px] text-dgray font-bold leading-4">Please enter the E-Mail addresses of the friends you would like to refer to COMPackage Employee Compensation Statement Software:</p>
                    <div class="mt-8 inline-block">
                        <public-referafriend></public-referafriend>
                    </div>
                    <p class="mt-3 font-serif text-[13px] text-dgray">Learn even more about our employee compensation software by <a class="underline text-dgreenclr" href="{{route('totalCompensationDemo')}}">viewing a short demo us</a> today.</p>
                </div>
            </div>
            <div class="w-full md:w-[40%] lg:w-[38%] py-5 px-5 lg:pt-20 lg:pb-5 lg:px-8 bg-bgbrwn">
                <public-sidebar2 pcurrent_route="{{ url()->current() }}"></public-sidebar2>
            </div>
        </div>
</div>
<div class="container mx-auto px-3.5">
    <div class="bg-greendarkclr p-5 rounded-b-lg"></div>
</div>
@endsection

