@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Research on the Impact Total Compensation Statements Have on Retention & Recruitment</h1>
                    <h2 class="mb-4 text-xl text-greendarkclr font-bold">by Joe Blattner</h2>
                    <img src="{{ asset('images/Research-on-the-Impact-Total.jpg') }}" class="article-image-custom" alt="compackage" style="width: 100%;max-width: 290px;float: right;margin-left: 7px;">
                    <p class="font-serif text-[13px] mb-3 text-dgray">There is a growing body of research that suggests that companies that issue total compensation statements to their employees can enjoy a number of benefits, including:</p>
                    <ol class="pl-5 list-disc mb-5 font-serif text-[13px]">
                        <li class="mb-1.5"><strong>Improved employee satisfaction and engagement leading to increased employee retention.</strong> When employees understand the full value of their compensation package, they are more likely to be satisfied with their job and engaged in their work. This can lead to increased productivity, decreased turnover, and a stronger company culture.</li>
                        <li class="mb-1.5"><strong>Attraction and retention of top talent.</strong> In today's competitive job market, top talent is more likely to consider a job offer from a company that is transparent about its compensation and benefits. A total compensation statement can help to set your company apart from the competition and attract the best and brightest employees.</li>
                    </ol>
                    <p class="font-serif text-[13px] mb-2 text-dgray">A study by the <a href="https://hbr.org/2015/10/most-people-have-no-idea-whether-theyre-paid-fairly" class="font-serif text-[#164900] text-[13px] underline underline-offset-1 font-bold leading-4" target="_blank">Society for Human Resource Management</a> (requires login) found that companies that issue total compensation statements have lower turnover rates than those that do not. The study also found that employees who receive total compensation statements are more likely to be satisfied with their jobs and to recommend their company to others.</p>
                    <p class="font-serif text-[13px] mb-2 text-dgray">Another study, by the consulting firm <a href="https://employeebenefits.co.uk/employers-total-reward-attract-retain-talent/" class="font-serif text-[#164900] text-[13px] underline underline-offset-1 font-bold leading-4" target="_blank">Towers Watson</a>, found that companies that issue total compensation statements are more likely to attract and retain top talent. The study also found that employees who receive total compensation statements are more likely to be engaged in their work and to be productive.</p>
                    <p class="font-serif text-[13px] mb-2 text-dgray">The research suggests that there are a number of benefits to companies that issue total compensation statements to their employees. These benefits include improved employee satisfaction and engagement, attraction and retention of top talent.</p>
                    <p class="font-serif text-[13px] mb-2 text-dgray">The study, The Impact of Total Rewards Communication on Employee Turnover Risk (2020) by CEB (now Gartner). study found that companies that provided total compensation statements to their employees had a 50% lower turnover risk than companies that did not. The study also found that employees who received them were more likely to be engaged in their work and to feel that they were fairly compensated.</p>
                    <p class="font-serif text-[13px] mb-2 text-dgray">The study, The Effects of Total Compensation Statements on Employee Morale and Satisfaction (2014) by the Society for Human Resource Management (SHRM) found that total compensation statements can help to improve employee morale and satisfaction. The study found that employees who received them were more likely to say that they were satisfied with their overall compensation package and that they were more likely to recommend their company to others as a good place to work.</p>
                    <p class="font-serif text-[13px] mb-2 text-dgray">According to a <a href="https://www.payscale.com/cbpr" class="font-serif text-[#164900] text-[13px] underline underline-offset-1 font-bold leading-4" target="_blank"> survey conducted by Payscale</a> in 2020, 38% of U.S. companies provide total compensation statements (up from 36% in their 2019 survey).</p>
                    <div class="mt-5 inline-block"></div>
                    <p class="font-serif text-[13px] mb-2 text-dgray"><strong>How do Total Compensation Statements help with recruiting and retention?</strong></p>
                    <ol class="pl-5 list-disc mb-5 font-serif text-[13px]">
                        <li class="mb-1.5">Total Compensation Statements offer employees a much clearer understanding of their total compensation.</li>
                        <li class="mb-1.5">Employees have a better understanding of their employer’s investment in them. According to <a href="https://www.reliableplant.com/Read/5764/51-underestimate-value-of-ir-total-compensation-" class="font-serif text-[#164900] text-[13px] underline underline-offset-1 font-bold leading-4" target="_blank">a survey conducted by Harris Interactive and Charlton Consulting Group</a>,  51% of employees underestimate the value of their total compensation.</li>
                        <li class="mb-1.5">Employees are better able to see that they are being fairly compensated. According to <a href="https://hbr.org/2015/10/most-people-have-no-idea-whether-theyre-paid-fairly" class="font-serif text-[#164900] text-[13px] underline underline-offset-1 font-bold leading-4" target="_blank"> this study by PayScale</a>, most employees do not realize they are being paid fairly.</li>
                    </ol>

                    <p class="font-serif text-[13px] mb-2 text-dgray">This article is sponsored by COMPackage – an online solution that allows you to easily, securely and inexpensively generate employee total compensation statements.</p>
                    <hr>
                    <p class="text-[15px] mt-5 mb-2  text-dgray">Click any of these links to learn more.</p>
                    <p class="mt-5 font-serif text-[13px] text-dgray"><a href="/" class="text-greendarkclr underline">Website</a></p>
                    <p class="font-serif text-[13px] text-dgray"><a href="{{route('sampleTotalCompensationReport')}}" class="text-greendarkclr underline">Sample Report</a></p>
                    <p class="font-serif text-[13px] text-dgray"><a href="{{route('compensationStatementPricing')}}" class="text-greendarkclr underline">Pricing</a></p>
                    <p class="font-serif text-[13px] text-dgray"><a href="https://www.compackage.com/ChooseDemo" class="text-greendarkclr underline">Demo</a></p>
                    <p class="font-serif text-[13px] text-dgray"><a href="https://www.compackage.com/contactus" class="text-greendarkclr underline">Contact Us</a></p>
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