@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
        <div class="w-full md:w-[60%] lg:w-[62%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Sitemap</h1>
                    <ul class="pl-5 list-disc text-dgreenclr">
						<li class="first"><a class="underline text-dgreenclr" href="{{route('totalCompensationStatements')}}">Total Benefit Statements</a>
							<ul class="pl-5 list-disc text-dgreenclr">
								<li><a class="underline text-dgreenclr" href="{{route('insuranceAgenciesBenefitsSoftware')}}">For Insurance Agencies</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('hrConsultantsBenefitsSoftware')}}">For HR Consultants</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('benefitsConsultantsSoftware')}}">For Benefits Consultants</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('accountingFirmsBenefitsSoftware')}}">For Accounting Firms</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('largeBusinessBenefitsSoftware')}}">For Large Businesses</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('smallBusinessBenefitsSoftware')}}">For Small Businesses</a></li>
							</ul>
						</li>
						<li><a class="underline text-dgreenclr" href="{{route('employeeBenefitResources')}}">Learn More</a>
                            <ul class="pl-5 list-disc text-dgreenclr">
								<li><a class="underline text-dgreenclr" href="{{route('totalCompensationDemo')}}">View a Free Demo</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('sampleTotalCompensationReport')}}">View a Total Compensation Statement</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('compensationStatementPricing')}}">View Pricing</a></li>
								<li><a class="text-dgreenclr">Practical uses of Employee Benefit Reports</a>
                                    <ul class="pl-5 list-disc text-dgreenclr">
										<li><a class="underline text-dgreenclr" href="{{route('employeeYearEndReports')}}">Year End Reports</a></li>
										<li><a class="underline text-dgreenclr" href="{{route('employeePerformanceReviews')}}">Employee Performance Reviews</a></li>
										<li><a class="underline text-dgreenclr" href="{{route('employeeRecruitment')}}">Employee Recruitment</a></li>
									</ul>
								</li>
								<li><a class="underline text-dgreenclr" href="{{route('benefitStatementGlossary')}}">Benefit Statement Glossary</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('benefitSoftwareFaq')}}">FAQ</a></li>
							</ul>
						</li>
						<li><a class="text-dgreenclr">Why COMPackage?</a>
                            <ul class="pl-5 list-disc text-dgreenclr">
								<li><a class="underline text-dgreenclr" href="{{route('hiddenEmployeeCompensationPerks')}}">Cost of Hidden Perks</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('employeeBenefitsCost')}}">Cost of Employee Benefits</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('reducingEmployeeTurnover')}}">Reducing Employee Turnover</a></li>
							</ul>
						</li>
						<li><a class="text-dgreenclr">About</a>
                            <ul class="pl-5 list-disc text-dgreenclr">
								<li class="first"><a class="underline text-dgreenclr" href="{{route('aboutus')}}">About Us</a></li>
								<li class="last"><a class="underline text-dgreenclr" href="{{route('productReviews')}}">Testimonials</a></li>
							</ul>
						</li>
						<li><a class="text-dgreenclr">Connect</a>
                            <ul class="pl-5 list-disc text-dgreenclr">
								<li class="first"><a class="underline text-dgreenclr" href="http://www.linkedin.com/in/joeblattner" target="_blank">Stay in Touch Through Linked In</a></li>
								<li><a class="underline text-dgreenclr" href="{{route('contact')}}">Tell an Associate about COMPackage</a></li>
								<li class="last"><a class="underline text-dgreenclr" href="http://blog.compackage.com" target="_blank">Subscribe to Our Blog</a></li>
							</ul>
						</li>
						<li><a class="underline text-dgreenclr" href="{{route('contact')}}">Contact Us</a></li>
						<li><a class="underline text-dgreenclr" href="{{route('purchaseform')}}">Purchase</a></li>
					</ul>
                </div>
            </div>
            <div class="w-full md:w-[40%] lg:w-[38%] py-5 px-5 lg:pt-20 lg:pb-5 lg:px-8 bg-bgbrwn">
                <public-sidebar pcurrent_route="{{ url()->current() }}"></public-sidebar>
            </div>
        </div>
</div>
<div class="container mx-auto px-3.5">
    <div class="bg-greendarkclr p-5 rounded-b-lg"></div>
</div>
@endsection

