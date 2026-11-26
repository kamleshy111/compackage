@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Customer Login</h1>
                    <p class="mb-3 font-serif text-[13px] text-dgray">Effective immediately, the Desktop Version of COMPackage appears to no longer be compatible with Microsoft's platform. Therefore, if you were using the Desktop version before, please purchase the Hosted version instead. (Same cost). Any questions, feel free to ask <a href="mailto:support@compackage.com" class="underline text-greendarkclr">support@compackage.com</a>. Thank you.</p>
                    <h3 class="text-xl text-greendarkclr font-bold">Users Log In Below</h3>
                    <div class="mt-2">
                        <public-purchaselogin></public-purchaselogin>
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

