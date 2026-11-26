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
                <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Are Total Compensation Statements Worth It for Small Businesses?</h1>
                <div class="section-1">
                    <p class="pb-3 font-serif text-[13px] text-dgray">For small and mid-sized businesses, every investment is scrutinized.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">So when the idea of total compensation statements comes up, the question is natural:</p>
                    <p class="pb-3 pl-3 font-serif text-[13px] text-dgray">Is this actually worth it?</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">The answer depends on one question:</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray"><strong>How well do your employees understand what they’re already receiving?</strong></p>
                </div>
                <div class="section-2">
                    <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">The Real Cost Isn’t the Tool</h2>
                    <div class="section-2--data">
                        <p class="pb-3 font-serif text-[13px] text-dgray">Most companies focus on:</p>
                        <ul class="list-disc pl-8">
                            <li>
                                <p class="pb-3 font-serif text-[13px] text-dgray">the cost of implementing something new</p>
                            </li>
                        </ul>
                        <p class="pb-3 font-serif text-[13px] text-dgray">But overlook:</p>
                        <ul class="list-disc pl-8">
                            <li>
                                <p class="pb-3 font-serif text-[13px] text-dgray">the cost of employees misunderstanding their compensation</p>
                            </li>
                        </ul>
                        <p class="pb-3 font-serif text-[13px] text-dgray">Because when employees don’t see the full picture:</p>
                        <ul class="list-disc pl-8">
                            <li>
                                <p class="pb-3 font-serif text-[13px] text-dgray">they feel underpaid</p>
                            </li>
                            <li>
                                <p class="pb-3 font-serif text-[13px] text-dgray">they’re more likely to leave</p>
                            </li>
                            <li>
                                <p class="pb-3 font-serif text-[13px] text-dgray">they undervalue your investment in them</p>
                            </li>
                        </ul>
                        <p class="pb-3 font-serif text-[13px] text-dgray"><a href="/why-do-employees-feel-underpaid-even-when-theyre-not" class="underline text-greendarkclr">Why do employees feel underpaid even when they’re not?</a></p>
                        <div class="section-3">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">What Small Businesses Get Wrong</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">Small businesses often assume, “We’re already paying competitively.”</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">Which is often true.</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">But employees don’t evaluate intent.</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">They evaluate what they can clearly see and understand.</p>
                            </div>
                        </div>
                        <div class="section-4">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">The ROI Comes From Retention</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">When employees understand their total compensation:</p>
                                <ul class="list-disc pl-8">
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">they’re less likely to leave</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">they better appreciate benefits</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">they make more informed decisions</p>
                                    </li>
                                </ul>
                                <p class="pb-3 pt-3 font-serif text-[13px] text-dgray">This can improve retention without increasing salaries.</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray"><a href="/how-can-companies-improve-retention-without-increasing-salaries" class="underline text-greendarkclr">How can companies improve retention without increasing salaries?</a></p>
                            </div>
                        </div>
                        <div class="section-5">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Why Total Compensation Statements Work</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">They solve a specific problem:</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">They take complex, scattered information and turn it into something employees can actually understand.</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray"><a href="/how-total-compensation-statements-improve-retention" class="underline text-greendarkclr">How total compensation statements improve retention</a></p>
                            </div>
                        </div>
                        <div class="section-6">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">For Small Businesses, This Matters Even More</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">Because:</p>
                                <ul class="list-disc pl-8">
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">every employee matters more</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">turnover is more disruptive</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">hiring is more expensive</p>
                                    </li>
                                </ul>
                                <p class="pb-3 pt-3 font-serif text-[13px] text-dgray">Improving retention without increasing payroll can have a disproportionate impact.</p>
                            </div>
                        </div>
                        <div class="section-7">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Bottom Line</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">The question isn’t just:</p>
                                <p class="pb-3 pl-3 font-serif text-[13px] text-dgray">“What does this cost?”</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">It’s:</p>
                                <p class="pb-3 pl-3  font-serif text-[13px] text-dgray">“What does it cost if employees don’t understand what we’re already providing?”</p>
                                <p class="pb-3 pl-3 font-serif text-[13px] text-dgray">For many small businesses, the answer makes the decision clear.</p>
                            </div>
                        </div>
                    </div>
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