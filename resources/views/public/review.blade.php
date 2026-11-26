@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
    <div class="row flex flex-wrap">
        <div class="w-full md:w-[60%] lg:w-[70%]">
            <div class="bg-white h-full py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Review</h1>
                <h2 class="pb-5 text-xl text-greendarkclr font-bold">Please rate your experience with COMPackage.</h2>
                <div class="review-navigation">
                    <ul class="review-items flex flex-wrap flex-col gap-y-3 w-[220px]">
                        <li class="review-item w-56">
                            <a href="{{route('reviewCP')}}" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Excellent</a>
                        </li>
                        <li class="review-item w-56">
                            <a href="{{ route('reviewFeedback', ['review' => 'Good']) }}" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Good</a>
                        </li>
                        <li class="review-item w-56">
                            <a href="{{ route('reviewFeedback', ['review' => 'Fair']) }}" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Fair</a>
                        </li>
                        <li class="review-item w-56">
                            <a href="{{ route('reviewFeedback', ['review' => 'Poor']) }}" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Poor</a>
                        </li>
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
