@extends('layouts.public')
@push('head')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "{{ $title ?? 'ComPackage Total Compensation Statement Software' }}",
        "operatingSystem": "Web",
        "applicationCategory": "BusinessApplication",
        "description": "{{ $description ?? 'ComPackage allows employers to clearly show employees the total value of their compensation, including benefits.'}}",
        "url": "{{ url()->current() }}",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "USD",
            "price": "499.00",
            "availability": "https://schema.org/InStock",
            "url": "{{ url()->current() }}"
        }
    }
</script>
@endpush
@section('content')
<div class="container mx-auto px-3.5">
    <div class="row flex flex-wrap">
        <div class="w-full md:w-[60%] lg:w-[70%]">
            <div class="bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Why Do Employees Feel Underpaid Even When They’re Not?</h1>
                <div class="section-1">
                    <p class="pb-3 font-serif text-[13px] text-dgray">Most companies assume compensation dissatisfaction is a pay problem.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Often, it’s not.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">It’s a visibility problem.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Employees typically evaluate what they earn based on one number: their salary. But their actual compensation includes much more - health insurance, retirement contributions, paid time off, employer taxes, and other benefits.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">The issue is simple:</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">If employees can’t clearly see it, they don’t count it. And when they don’t count it, they feel underpaid.</p>
                </div>
                <div class="section-2">
                    <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">The Perception Gap</h2>
                    <div class="section-2--data">
                        <p class="pb-3 font-serif text-[13px] text-dgray">Let’s say an employee earns $80,000.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">Their employer may actually be spending:</p>
                        <ul class="list-disc pl-8">
                            <li>
                                <p class="font-serif text-[13px] text-dgray">$10,000–$15,000 on health insurance</p>
                            </li>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">$4,000–$6,000 in retirement contributions</p>
                            </li>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">thousands more in payroll taxes and benefits</p>
                            </li>
                        </ul>
                        <p class="pb-3 font-serif text-[13px] text-dgray">But none of that is top of mind. So the employee compares:</p>
                        <ul class="list-disc pl-8">
                            <li>
                                <p class="font-serif text-[13px] text-dgray">their $80,000 salary</p>
                            </li>
                            <p class="font-serif text-[13px] text-dgray">to</p>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">a $90,000 offer elsewhere</p>
                            </li>
                        </ul>
                        <p class="pb-3 font-serif text-[13px] text-dgray">and concludes they’re underpaid. Even when they’re not!</p>
                    </div>
                </div>
                <div class="section-3">
                    <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Why This Matters More Than Ever</h2>
                    <div class="section-2--data">
                        <p class="pb-3 font-serif text-[13px] text-dgray">Today’s workforce:</p>
                        <ul class="list-disc pl-8">
                            <li>
                                <p class="font-serif text-[13px] text-dgray">changes jobs more frequently</p>
                            </li>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">compares compensation more actively</p>
                            </li>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">expects transparency</p>
                            </li>
                        </ul>
                        <p class="pb-3 font-serif text-[13px] text-dgray">If they don’t understand what they’re receiving, they fill in the gaps themselves.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">Usually incorrectly.</p>
                    </div>
                </div>
                <div class="section-4">
                    <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">What Companies Miss</h2>
                    <div class="section-2--data">
                        <p class="pb-3 font-serif text-[13px] text-dgray">Most companies are paying competitively.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">They just aren’t <Strong>communicating it effectively.</Strong></p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">And that leads to:</p>
                        <ul class="list-disc pl-8">
                            <li>
                                <p class="font-serif text-[13px] text-dgray">unnecessary turnover</p>
                            </li>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">constant compensation pressure</p>
                            </li>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">undervalued benefits investments</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section-5">
                    <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Where This Leads</h2>
                    <div class="section-2--data">
                        <p class="pb-3 font-serif text-[13px] text-dgray">If employees feel underpaid - even when they aren’t - the natural next question becomes:</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray"><a href="/how-can-companies-improve-retention-without-increasing-salaries" class="underline text-greendarkclr">How can companies improve retention without increasing salaries?</a></p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">Because raising salaries isn’t always the right (or sustainable) answer.</p>
                    </div>
                </div>
                <div class="section-6">
                    <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">The Real Solution</h2>
                    <div class="section-2--data">
                        <p class="pb-3 font-serif text-[13px] text-dgray">The solution isn’t just paying more.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">It’s <strong>helping employees understand what they already have.</strong></p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">One of the most effective ways companies are addressing this is by clearly showing employees their full compensation - salary, benefits, and employer contributions in one place.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray"><a href="/how-total-compensation-statements-improve-employee-retention" class="underline text-greendarkclr">How total compensation statements improve retention</a></p>
                    </div>
                </div>
                <div class="section-7">
                    <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Bottom Line</h2>
                    <div class="section-2--data">
                        <p class="pb-3 font-serif text-[13px] text-dgray">Employees don’t leave because of numbers alone.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">They leave because of what they <em>believe</em> those numbers mean.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">Fix the perception, and you often fix the problem.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class=" w-full md:w-[40%] lg:w-[30%] py-5 px-5 lg:pt-20 lg:pb-5 lg:px-8 bg-bgbrwn">
            <public-sidebar pcurrent_route="{{ url()->current() }}"></public-sidebar>
        </div>
    </div>
</div>
<div class="container mx-auto px-3.5">
    <div class="bg-greendarkclr p-5 rounded-b-lg"></div>
</div>
@endsection