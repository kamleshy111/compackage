@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Stay in Contact with COMPackage</h1>
                    <h3 class="pb-5 text-xl text-greendarkclr font-bold leading-5">Follow us, friend us, and stay up-to-date on the latest information on total employee benefits. Keep informed about the latest changes to our total compensation statement software.</h3>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Connect with Joe Blattner, Founder of COMPackage on:<span class="block"><a class="text-greendarkclr underline" target="_blank" href="http://www.linkedin.com/in/joeblattner">LinkedIn</a></span></p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Connect with COMPackage on:</p>
                    <ul class="mb-5">
                        <li class="mb-1 text-[13px] font-serif flex items-center"><img class="mr-2" src="{{ asset('images/gplus.png') }}" alt="Google Plus" /><a class="text-greendarkclr underline" href="https://plus.google.com/113669704258318451394" target="_blank">Google Plus</a></li>
                        <li class="mb-1 text-[13px] font-serif flex items-center"><img class="mr-2" src="{{ asset('images/facebook.jpg') }}" alt="facebook" /><a class="text-greendarkclr underline" href="https://www.facebook.com/TotalCompensationReports/" target="_blank">Facebook</a></li>
                        <li class="mb-8 text-[13px] font-serif flex items-center"><img class="mr-2" src="{{ asset('images/linkedIn.jpg') }}" alt="linkedIn" /><a class="text-greendarkclr underline" href="https://www.linkedin.com/company/compackage" target="_blank">LinkedIn</a></li>
                        <li class="text-[13px] font-serif flex items-center"><img class="mr-2" src="{{ asset('images/rss.jpg') }}" alt="RSS" />You can also&nbsp;<a class="text-greendarkclr underline" href="http://feeds.feedburner.com/CompackageBlog" target="_blank">Subscribe to the COMPackage Total Benefits Blog</a></li>
                    </ul>
                    <p class="font-serif text-[13px] text-dgray"><a class="text-greendarkclr underline" href="{{route('contact')}}">Contact us</a> if you have any questions about COMPackage Total Compensation Statements or if you would like to tell us what you think of our product.</p>
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

