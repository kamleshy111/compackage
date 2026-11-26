@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
    <div class="row flex flex-wrap">
        <div class="w-full md:w-[60%] lg:w-[70%]">
            <div class="bg-white h-full py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Review COMPackage</h1>
                <div class="mb-3">
                    <img src="{{ asset('images/Google-Review.jpg') }}" class="w-60" alt="Google Review">
                    <h2 class="mt-2 pb-3 text-xl text-greendarkclr font-bold">If you already have a Google account, click on the button below and leave a review.</h2>
                    <a href="https://g.page/r/CaRhbYsSepHsEAI/review" target="_blank" class="w-[220px] rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Google Review</a>
                </div>
                <div class="w-full">
                    <p class="mb-2">Don’t have a Google account? It’s free, takes only two minutes to set up, and you can use your own email address.</p>
                    <ol class="mb-3 pl-5 list-decimal font-serif text-[13px] text-dgray">
                        <li>Go to <a href="https://google.com/" class="text-greendarkclr underline">Google.com</a></li>
                        <li>Click <strong class="">Sign in</strong> (button at upper right)</li>
                        <li>Click <strong>Create Account</strong> (link at bottom)</li>
                        <li>Follow instructions from there.</li>
                    </ol>
                    <h2 class="pb-3 text-xl text-greendarkclr font-bold">Thank you for our review! It is much appreciated!</h2>
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
