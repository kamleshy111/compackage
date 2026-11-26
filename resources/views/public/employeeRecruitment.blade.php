@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Compensation Software for Recruitment</h1>
                    <div class="row flex flex-wrap mb-5 md:mb-0 -mx-2.5">
                        <div class="px-2.5 w-full md:w-3/5">
                            <p class="font-serif text-[13px] mb-3 text-dgray">Just as COMPackage employee compensation software can deliver detailed reports to your present employees very easily on a pro forma basis, it can also be used to make presentations to potential employees.</p>
                            <p class="font-serif text-[13px] mb-3 text-dgray">One of the biggest factors new hires consider when they’re looking for job opportunities is compensation and benefits. By taking a proactive approach and presenting this information in a clear report during recruiting, you can help make their decision a little easier.</p>
                            <p class="font-serif text-[13px] mb-3 text-dgray">Many employers have found a great deal of success using our compensation software in their recruiting. When potential candidates see how much they’ll receive in benefits through the report’s powerful use of graphics, colors and design, they are usually quite impressed. They’re then more likely to think about their total compensation instead of just their base pay when making their employment decision.</p>
                        </div>
                        <div class="px-2.5 w-full md:w-2/5">
                            <h2 class="mb-1.5 text-lg font-bold text-dgray">COMPackage Features</h2>
                            <ul class="font-serif text-[13px] pl-5 list-disc">
                                <li class="mb-2">Take COMPackage compensation software to recruitment events and build reports on the fly</li>
				        	    <li class="mb-2">Prepare reports pro forma, then again if you wish at the final offer, at the 1st review, AND at year end… all at no additional cost</li>
        					    <li>If you have unique and special employee benefit, COMPackage is the only report that if you can put a number to it, we can demonstrate it!</li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="font-serif text-[13px] mb-1 text-dgray">COMPackage compensation software usually works best for high-profile hires. Chances are, the more important a recruit is to your company, the more benefits and perks you plan on offering. By showcasing these benefits through a COMPackage compensation report, you’re presenting a powerful argument for your company.</h3>                
                    <p class="font-serif text-[13px] mb-3 text-dgray">If you download COMPackage, you’re free to use the compensation software as much or as little as you want during your recruiting. Remember that it's not only about the pay. <strong>It's about the entire package!</strong></p>
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