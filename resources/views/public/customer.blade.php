@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Purchase COMPackage</h1>
                    <h3 class="text-xl text-greendarkclr font-bold">Welcome COMPackage Customers</h3>
                    <div class="mb-8 mt-6">
                        <span class="inline-block bg-[#D7DAEB] px-2 py-1.5 w-full text-[#3a478b] text-base mb-1.5">Resubscribe</span>
                        <p class="text-xs mb-1">Is your COMPackage license expired or close to expiring?</p>
                        <a href="{{route('purchaseform')}}" class="text-sm text-greendarkclr underline underline-offset-1">Purchase a new subscription here!</a>
                    </div>
                    <div class="mb-4">
                        <span class="inline-block bg-[#D7DAEB] px-2 py-1.5 w-full text-[#3a478b] text-base mb-1.5">Purchase Additional Reports</span>
                        <p class="text-xs mb-1">Do you need additional reports?</p>
                        <a href="{{route('purchaseform')}}" class="text-sm text-greendarkclr underline underline-offset-1">Purchase additional reports here!</a>
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

