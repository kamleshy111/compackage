@extends('layouts.public')
@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[62%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Contact COMPackage - 833-468-7674</h1>
                    <h2 class="pb-5 text-xl text-greendarkclr font-bold leading-5">If you have any questions or would like more information, feel free to contact us using the form below. We are happy to answer any questions you may have.</h2>
                    <p class="pb-3 font-serif text-[13px] text-dgray">We are also interested in any ideas you may have for improving our total compensation reporting software. Please provide your thoughts in the comments below. We thank you for your input and insights.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">If you have a technical issue or concern with the software, please email <a class="underline text-greendarkclr" href="mailto:support@compackage.com">support@compackage.com</a>.</p>
                    <p class="font-serif text-[13px] text-dgray">If you are interested in purchasing a Reseller License, please email <a class="underline text-greendarkclr" href="mailto:jblattner@compackage.com">jblattner@compackage.com</a>.</p>
                    <div class="mt-8 inline-block">
                        <public-contactform></public-contactform>
                    </div>
                    <div class="flex flex-wrap -mx-2 mt-3">
                        <div class="lg:w-1/2 w-full px-2 mb-3 lg:mb-0">
                            <p class="pb-3 font-serif text-[13px] text-dgray">You can also <a class="underline text-greendarkclr" href="{{route('stayConnected')}}">stay connected</a> with COMPackage through several social media channels and our <a class="underline text-greendarkclr" href="http://blog.compackage.com/" target="_blank">total benefits blog</a>.</p>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 mb-3 lg:mb-0">
                            <p class="pb-3 font-serif text-[13px] text-dgray">COMPackage Corp.<br>PO Box 152<br>Presto PA, 15142<br>833-468-7674</p>
                        </div>
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