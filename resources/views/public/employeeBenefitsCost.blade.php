@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">How Much Should Employers Spend on Benefits?</h1>
                    <p class="pb-3 font-serif text-[13px] text-dgray">One of the toughest decisions employers have to make is how to dole out employee benefits. If laborers receive too few benefits, they're likely to grow dissatisfied and start searching for a job that pays them a salary closer to the industry average. If employers emphasize benefits too much, however, they're spending money that might be put to better use somewhere else in the company.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Many employers decide employee benefits by looking at an annual report published by the U.S. Bureau of Labor Statistics. This report reviews the average salaries and benefits paid to both private and government workers. The March 2010 report showed that benefits make up 30.4% of the average laborer's paycheck. 1   We've even seen this statistics suggesting this number to be as high as almost 44% of the average laborer's paycheck.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Benefits were divided into the following categories:</p>
                    <ul class="pl-5 mb-5 list-disc">
                        <li class="font-serif text-[13px] text-dgray mb-2"><span class="block">Insurance - 8.8%</span><span class="block">This includes health care, disability insurance and life insurance. Of these three types, employers contribute the most to health care. According to the Bureau of Labor Statistics, 8.3% of an employee's total salary goes to health insurance.</span></li>
                        <li class="font-serif text-[13px] text-dgray mb-2"><span class="block">Legally Required - 7.7%</span><span class="block">Benefits that are legally required include Social Security, Medicare, unemployment insurance and workers' compensation.</span></li>
                        <li class="font-serif text-[13px] text-dgray mb-2"><span class="block">Paid Leave - 6.9%</span><span class="block">Paid leave includes holidays, vacations, sick time and personal leave. According to a 2007 Mercer Resources survey, the average United States worker gets 25 days off per year - 15 paid vacation days off and 10 paid public holidays. 2</span></li>
                        <li class="font-serif text-[13px] text-dgray mb-2"><span class="block">Retirement and Savings - 4.5%</span><span class="block">This category can be split into benefits programs and contribution plans. Among private industries, contribution plans are slightly more popular than benefit programs; whereas state and local government feature huge benefit programs with almost nonexistent contribution plans.</span></li>
                        <li class="font-serif text-[13px] text-dgray">Supplemental Pay - 2.5% Supplemental pay includes everything from overtime pay to bonuses. This is one of the few areas where private industry outpaces state and local governments.</li>
                    </ul>
                    <p class="pb-3 font-serif text-[13px] text-dgray">When evaluating these numbers, it is important to remember that different industries may place a stronger emphasis on certain benefits. However, if we use the average numbers provided, an employee with an annual salary of $50,000 would have a total compensation of $71,839. That employee would be paid:</p>
                    <ul class="pl-5 mb-5 list-disc">
                        <li class="font-serif text-[13px] text-dgray">$6,322 for insurance</li>
                        <li class="font-serif text-[13px] text-dgray">$5,532 for legally required benefits</li>
                        <li class="font-serif text-[13px] text-dgray">$4,957 for paid leave</li>
                        <li class="font-serif text-[13px] text-dgray">$3,233 for retirement and savings</li>
                        <li class="font-serif text-[13px] text-dgray">$1,796 for supplemental pay</li>
                    </ul>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Use these statistics to evaluate the benefits you're offering. If your benefits program is lacking, consider investing in your work force. By bringing employee benefits up to standard, especially when your company is going through a difficult time, you are telling your employees that you value them. Your work force will be likely to remember your actions and stick with you, even when other opportunities arise. Most employees making $50,000 per year would be shocked to learn that they are receiving an additional $21,839 in benefits. Increase your work force's loyalty by showing them how much they are receiving in benefits through a total compensation report from COMPackage.</p>
                    <ol class="mb-5 list-decimal pl-5">
                        <li class="font-serif text-[13px] text-dgray"><a href="http://www.bls.gov/news.release/pdf/ecec.pdf" target="_blank" class="text-greendarkclr underline">http://www.bls.gov/news.release/pdf/ecec.pdf</a></li>
                        <li class="font-serif text-[13px] text-dgray"><a href="http://www.cnn.com/SPECIALS/2007/work.life.balance/chart/" target="_blank" class="text-greendarkclr underline">http://www.cnn.com/SPECIALS/2007/work.life.balance/chart/</a></li>
                    </ol>
                    <hr />
                    <p class="mt-5 mb-2 font-serif text-[13px] text-dgray">View a free demo of <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">Total Compensation Reports</a>.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">View a <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">sample compensation report</a>.</p>
                    <p class="font-serif text-[13px] text-dgray">See <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of compensation reports</a> for pricing.</p>
                    <div class="mt-4">
                        <a href="{{route('purchaseform')}}" class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-9 px-9 md:py-1.5 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg">Purchase Now</a>
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

