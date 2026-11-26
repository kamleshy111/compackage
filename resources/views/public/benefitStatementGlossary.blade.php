@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Benefit Statement Glossary</h1>
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Accelerated Life Insurance Benefits</strong> - This is when benefit payments from life insurance or long-term benefit plans are increased to cover expenses for a chronically ill individual.</p>    
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Annual Enrollment</strong> - designated time frame when new benefits and plan changes are communicated to employees; and they can make benefit changes or new elections for the upcoming plan year.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Base Pay</strong> - an amount or a rate of compensation for a specified position of employment or activity excluding any other payments or allowances.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Benefit Statement</strong> - customized to the employer and personalized to each employee showing the value of their total compensation and company-provided benefits; may include current benefit elections and a variety of other information. Typically provided on annual basis.</p>				 
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Current Benefit Statement</strong> - indicates the benefit statement has been produced by taking data from a specific, current date and then annualized.</p> 
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Flexible Benefits Plan</strong> - nontaxable plans and permissible taxable benefits, including cash.  May be limited to a health and welfare plan that offers the choice of pre-tax premium deductions, or as grand as selection among various benefits, with pre- or post-tax deductions, various levels of benefits, spending accounts, or cash. Also referred to as Cafeteria Plan.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Flexible Spending Account (FSA)</strong> - an account by which an employee uses pre-tax deductions to accumulate funds for reimbursement of eligible expenses.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Historical Benefit Statement</strong> - indicates the benefit statement has been produced using 12-month historical information regarding compensation and benefits.</p>
                    <p class="font-serif text-[13px] text-dgray mb-3"><strong>Mandated Benefit</strong> - a benefit that is required by law to provide. Examples include Social Security and Medicare, Federal and State unemployment insurance taxes, and workers' compensation. </p>				  
                    <p class="font-serif text-[13px] text-dgray"><strong>Total Compensation Statement</strong> - newer term for benefit statement that encompasses total compensation. Also referred to as Total Rewards Statement.</p>  
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