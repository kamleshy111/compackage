@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
    <div class="row flex flex-wrap">
        <div class="w-full md:w-[60%] lg:w-[70%]">
            <div class="bg-white h-full py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">About Us</h1>
                <h2 class="pb-5 text-xl text-greendarkclr font-bold">Helping Any Sized Business Communicate with Employees Using Total Compensation Statement Software Solutions</h2>
                <p class="pb-3 font-serif text-[13px] text-dgray">COMPackage is the vision of Joe Blattner who was convinced that employees and companies would benefit if everyone understood the true value of their total compensation packages. He believed that a full-featured, easy-to-use total compensation statement software solution could be provided in a way that allowed small businesses to provide Total Compensation Reports to their employees. Through this benefit statement software, mid-sized companies could avoid costly service provider fees and process all of the Total Compensation reports in-house in less than one day (vs. weeks or months). COMPackage is the realization of that vision.</p>
                <p class="pb-3 font-serif text-[13px] text-dgray"><a class="underline text-greendarkclr" href="{{route('totalCompensationDemo')}}">Watch a demo</a> of COMPackage’s total compensation statement software in action today.</p>
                <div class="row flex flex-wrap -mx-2.5">
                    <div class="w-full md:w-3/5 lg:w-4/5 px-2.5">
                        <p class="pb-3 font-serif text-[13px] text-dgray">COMPackage represents some of what Blattner learned about employee benefit reporting during a 30-year career, during which he founded <a class="underline text-greendarkclr" href="http://brunnerworks.com/" target="_blank">Blattner Brunner</a>, today the largest advertising agency in Pittsburgh. Blattner founded the company at age 19 and grew it to a 120-employee organization when he sold it in 2003.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">One thing he carried away from his experience as a business owner, as well as what he learned from fellow entrepreneurs, was that while business owners understood the value of this total compensation statement software and wanted to distribute such reports, they historically found them too complex, time consuming and costly.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">Blattner set out to identify processes and develop the technology to overcome certain obstacles and formed COMPackage to market the total compensation statement software solutions he discovered. Blattner has worked with some of the brightest Internet professionals at <a class="underline text-greendarkclr" href="http://www.mism.cmu.edu/" target="_blank">Carnegie Mellon University's Master of Information Systems Management Program</a>, and others, to develop COMPackage.</p>                        
                    </div>
                    <div class="w-full md:w-2/5 lg:w-1/5 px-2.5">
                        <img src="{{ asset('images/blattnerbruner.jpg') }}" alt="Blattner Bruner">
                        <p class="pt-2 font-serif text-[11px] text-[#660000] italic">In 1974 at age 19 and with only $34.00, Joe Blattner started a business that today is the largest employing advertising agency in the Pittsburgh region.</p>
                    </div>
                </div>
                <p class="pb-3 font-serif text-[13px] text-dgray">In addition to COMPackage total compensation statements and employee benefit software management, Blattner consults medium sized companies on business, marketing and executive management issues, and in 2012 launched his 2nd Internet business endeavor: <a class="underline text-greendarkclr" href="http://www.class-g.org/" target="_blank">Class-G.org</a>, that measures, certifies and communicates the level of a company's sustainable management at all of their locations.</p>
                <p class="pb-3 font-serif text-[13px] text-dgray">For more information about COMPackage’s total compensation statement software solutions, <a class="underline text-greendarkclr" href="{{route('contact')}}">contact us</a> today.</p>
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
