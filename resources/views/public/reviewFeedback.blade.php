@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
    <div class="row flex flex-wrap">
        <div class="w-full md:w-[60%] lg:w-[70%]">
            <div class="bg-white h-full py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Review Feedback</h1>
                <h2 class="mt-2 pb-3 text-xl text-greendarkclr font-bold">We value your honest feedback!</h2>
                <p>COMPackage is always continuously improving. Please let us know what you think of our services, and what we can do to make things better. If you’d like a response, please include your email and/or phone number.</p>
                <div class="mt-8 inline-block w-full">
                    <public-review-feedback></public-review-feedback>
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
