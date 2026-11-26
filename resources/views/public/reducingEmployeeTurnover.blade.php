@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Costs of Employee Turnover – How Can Benefit Statements Help?</h1>
                    <p class="font-serif text-[13px] mb-2 text-dgray">In tough economic times, it can sometimes seem like there are no more places to make cuts. You’re no longer matching 401(k) contributions, you’ve made staffing cuts; you’ve even switched to single-ply toilet paper. If you’re still not sure what to do to increase profits, consider turning your attention to reducing employee turnover.</p>
                    <p class="font-serif text-[13px] mb-4 text-dgray">Because turnover costs are hard to pin down, most companies just ignore them. Many employers don’t take the time to calculate their exact costs for replacing a worker since they figure that the cost is minimal and unavoidable. In fact, HR experts estimate that the cost of replacing one employee is at least 25 percent of that employee’s annual salary.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">These costs include:</p>
                    <h2 class="font-bold mb-2 font-serif text-[13px] text-dgray">Separation Costs</h2>
                    <ul class="mb-4 pl-5 list-disc font-serif text-[13px] text-dgray">
						<li>Cost of exit interview</li>
						<li>Increase in unemployment tax</li>
						<li>Separation pay</li>
						<li>Administrative costs</li>		
					</ul>
                    <h3 class="font-bold mb-2 font-serif text-[13px] text-dgray">Replacement Costs</h3>
                    <ul class="mb-4 pl-5 list-disc font-serif text-[13px] text-dgray">
						<li>Placing job ads</li>
						<li>Cost of employees' time for interviewing process</li>
						<li>Background check cost</li>
						<li>Bonuses and administrative costs</li>		
					</ul>
                    <h3 class="font-bold mb-2 font-serif text-[13px] text-dgray">Training Costs</h3>
                    <ul class="mb-4 pl-5 list-disc font-serif text-[13px] text-dgray">
						<li>Cost of training material</li>
						<li>Cost of trainers time</li>
						<li>Time it takes new employee to ramp up</li>		
					</ul>
                    <p class="mb-2 font-serif text-[13px] text-dgray">Intangible costs also include the stress a short staff puts on other workers, interrupted client dialogue and lost company knowledge. If you add it all up, you are probably losing much more than you thought on each employee that leaves your company, so doesn’t it make sense to start doing something about it?</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">The solution to reducing turnover is different for every company. The most important thing you need to do is find out exactly why employees are not happy with your company and fix it. Are employees overworked? Do they hate the work environment? Do they want more competitive salary and benefits? You may not see a dramatic change within a couple weeks or even months, but whatever money you invest in your employees in the short term, you’ll see multiplied in the long term with reduced turnover and higher profits.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">One tool that has effectively reduced turnover time and time again is employee benefit statement software. How can a solution that shows employees the value of their employment help you lower costly employee turnover?</p>
                    <ul class="mb-4 pl-5 list-disc font-serif text-[13px] text-dgray">
						<li>Most employees are surprised to learn just how much their benefits add to their total compensation, making them much less likely to leave for salary and benefit reasons.</li>
						<li>Employees like to know how much they are valued. You spend a lot to keep them happy, why not improve morale by showing your employees how much their benefits are worth.</li>
						<li>Employee benefit statements presented along with employee reviews can motivate employees by showing them how much they could be worth when they are promoted to the next level.</li>
					</ul>
                    <hr>
                    <p class="mt-5 mb-2 font-serif text-[13px] text-dgray">View a free demo of <a href="{{route('totalCompensationDemo')}}" class="text-greendarkclr underline">Total Compensation Reports</a>.</p>
                    <p class="mb-2 font-serif text-[13px] text-dgray">View a <a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">sample compensation report</a>.</p>
                    <p class="font-serif text-[13px] text-dgray">See <a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">pricing of compensation reports</a> for pricing.</p>
                    <div class="mt-4"><a href="{{route('purchaseform')}}" class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-9 px-9 md:py-1.5 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg inline-block">Purchase Now</a></div>
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