@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Benefit Statement Software 30-Day Money-Back Guarantee</h1>
                    <p class="pb-3 font-serif text-[13px] text-dgray">At COMPackage, we're so confident that you'll see immediate benefits from our benefit statement software, that we provide an unconditional money-back guarantee for 30 days from your original purchase. If you are not 100% satisfied with our software and/or reports, you may discontinue using the product and receive a full refund. We're always working to improve our benefit statement software, so if you're unsatisfied with it in any way or if you have suggestions for making it any better, feel free to <a href="{{route('contact')}}" class="text-greendarkclr underline">email us</a> about it. Also, please <a href="{{route('contact')}}" class="text-greendarkclr underline">contact us</a> if you have any problems using the software or if you have any questions about its features.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">With a money-back guarantee, you have no excuse to not try our benefit statement software. <a href="{{route('purchaseform')}}" class="text-greendarkclr underline">Purchase COMPackage Total Compensation Report software</a> today.</p>
                    <div style="background-image:url('{{ asset('images/guaranteeborder_sm.jpg') }}')" class="text-center bg-no-repeat bg-cover lg:bg-contain bg-center">
                        <div class="px-10 py-16">
                            <h2 class="text-black text-xs font-bold">30-Day Money-Back Guarantee</h2>
                            <p class="text-black text-xs">For any reason whatsoever due to your error or ours, should our benefit statement software not deliver to your satisfaction, please contact us within 30 days of your original purchase to request a full refund. Include a brief description of the problem. Within approximately 7 business days, we will process the refund per your request. Either way, however, your purchase satisfaction is fully guaranteed.</p>
                        </div>
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

