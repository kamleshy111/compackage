@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Sample Employee Compensation Statement</h1>
                    <p class="pb-3 font-serif text-[13px] text-dgray">The sample below demonstrates just how simple and powerful COMPackage’s employee compensation statements are. These colorful, easy-to-use tools work because they can show employees exactly how much they’re earning in just a few seconds.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Even though these statements include as many as 60 different perks and benefits, they can usually be created in just 5-7 minutes. Best of all, you can run as many of these thorough employee compensation statements as you want for just $20 per employee per statement. <a href="" class="text-greendarkclr underline">Purchase benefit statement software</a> today or <a href="" class="text-greendarkclr underline">view a free demo</a>.</p>
                    <p class="pb-3 font-serif text-[12px] text-dgray">Click the report image below to download the full-size PDF sample employee compensation statement.</p>
                    <div class="mt-4">
                        <a href="{{ asset('images/sample-compensation-statement.pdf') }}" target="_balnk"><img alt="Sample Total Compensation Report" src="{{ asset('images/sample-report.gif') }}" /></a>
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