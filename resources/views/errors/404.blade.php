
@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Whoops! It seems you’ve arrived at a page that does not exist!</h1>
                    <h2 class="pb-5 text-xl text-greendarkclr font-bold leading-5">COMPackage is the leader in Total Compensation Statements. Here are some things you might have been looking for:</h2>
                    <ul class="pl-5 list-disc mb-4">
						<li><a href="{{route('home')}}" class="text-greendarkclr">Home</a></li>
						<li><a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr">Demo</a></li>
						<li><a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr">Sample</a></li>
						<li><a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr">Pricing</a></li>
					</ul>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Thank you for visiting COMPackage.com!</p>
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
