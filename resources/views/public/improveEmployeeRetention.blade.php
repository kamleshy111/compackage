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
                <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">How Total Compensation Statements Improve Employee Retention</h1>
                <div class="section-1">
                    <p class="pb-3 font-serif text-[13px] text-dgray">Employee retention is often treated as a compensation problem.</p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">But more often, it’s a <strong>communication problem.</strong></p>
                    <p class="pb-3 font-serif text-[13px] text-dgray">Employees leave not just because of what they earn - but because of what they believe they earn.</p>
                </div>
                <div class="section-2">
                    <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Where Retention Problems Start</h2>
                    <div class="section-2--data">
                        <p class="pb-3 font-serif text-[13px] text-dgray">Retention issues often begin with a simple perception:</p>
                        <p class="pb-3 pl-3 font-serif text-[13px] text-dgray">“I’m not being paid enough.”</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">But that perception is frequently incomplete.</p>
                        <p class="pb-3 font-serif text-[13px] text-dgray"><a href="/why-do-employees-feel-underpaid-even-when-theyre-not" class="underline text-greendarkclr">Why do employees feel underpaid even when they’re not?</a></p>
                        <p class="pb-3 font-serif text-[13px] text-dgray">Employees are often unaware of:</p>
                        <ul class="list-disc pl-8">
                            <li>
                                <p class="font-serif text-[13px] text-dgray">employer-paid benefits</p>
                            </li>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">retirement contributions</p>
                            </li>
                            <li>
                                <p class="font-serif text-[13px] text-dgray">the true cost of their compensation</p>
                            </li>
                        </ul>
                        <div class="section-3">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">What Total Compensation Statements Do</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">Total compensation statements bring everything together:</p>
                                <ul class="list-disc pl-8">
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">salary</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">benefits</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">employer contributions</p>
                                    </li>
                                </ul>
                                <p class="pb-3 font-serif text-[13px] text-dgray">…into a single, clear view.</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">Instead of fragmented information, employees see the full picture.</p>
                            </div>
                        </div>
                        <div class="section-4">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Why This Changes Behavior</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">When employees understand their full compensation:</p>
                                <ol class="list-decimal pl-8">
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray"><strong>They reassess their value</strong></p>
                                        <p class="pb-3 font-serif text-[13px] text-dgray">What seemed “low” may actually be competitive</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray"><strong>They better understand trade-offs</strong></p>
                                        <p class="pb-3 font-serif text-[13px] text-dgray">Leaving means giving up more than just salary</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray"><strong>They feel more appreciated</strong></p>
                                        <p class="pb-3 font-serif text-[13px] text-dgray">Because the company’s investment is visible</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="section-5">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">The Retention Impact</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">This is why many companies are now focused on <a href="/how-can-companies-improve-retention-without-increasing-salaries" class="underline text-greendarkclr">How can companies improve retention without increasing salaries?</a></p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">Because improving understanding can:</p>
                                <ul class="list-disc pl-8">
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">reduce unnecessary turnover</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">decrease compensation pressure</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">strengthen employee trust</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section-6">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Where COMPackage Fits</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">Solutions like COMPackage are designed specifically to:</p>
                                <ul class="list-disc pl-8">
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">make compensation clear</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">present it in a way employees actually understand</p>
                                    </li>
                                    <li>
                                        <p class="font-serif text-[13px] text-dgray">highlight the full value of what companies provide</p>
                                    </li>
                                </ul>
                                <p class="pb-3 pt-2 font-serif text-[13px] text-dgray">This isn’t about adding benefits.</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">It’s about <strong>making existing benefits visible and meaningful.</strong></p>
                            </div>
                        </div>
                        <div class="section-7">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Is It Worth It?</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">For many organizations, the final question is, <a href="/are-total-compensation-statements-worth-it-for-small-businesses" class="underline text-greendarkclr">Are total compensation statements worth it for small businesses?</a></p>
                            </div>
                        </div>
                        <div class="section-8">
                            <h2 class="pt-5 pb-3 text-xl text-greendarkclr font-bold">Bottom Line</h2>
                            <div class="section-2--data">
                                <p class="pb-3 font-serif text-[13px] text-dgray">Retention doesn’t always require bigger budgets.</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">Sometimes it requires better communication.</p>
                                <p class="pb-3 font-serif text-[13px] text-dgray">And when employees clearly see what they’re receiving, they’re far more likely to stay.</p>
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