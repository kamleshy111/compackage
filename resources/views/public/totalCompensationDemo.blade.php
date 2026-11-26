@extends('layouts.public')
@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[62%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="mb-5 text-3xl text-greendarkclr font-bold">Total Compensation Statements - View Our Free Demo</h1>
                    <h2 class="pb-5 text-xl text-greendarkclr font-bold leading-5">COMPackage employee benefit reports are so easy to use that we want you to see first-hand how easy - view the free COMPackage demo today!</h2>
                    <p class="pb-8 font-serif text-[13px] text-dgray">Simply fill out the form below and you will automatically be taken to the user-controlled demo. Don't worry - we won't give your contact information to anyone. We maintain 100% confidentiality.</p>
                    <div class="pb-3 items-center"><h3 class="text-xl text-greendarkclr font-bold leading-5 mr-4">Access Our Free Demo Now</h3></div>
                    <div class="mt-8 inline-block">
                        <public-totalcompensationdemo redirect_url="{{route('ChooseDemo')}}"></public-totalcompensationdemo>
                    </div>
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