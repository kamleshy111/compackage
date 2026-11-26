@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        @if(session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Purchase COMPackage</h1>
                    <p class="pb-3 font-serif text-xs text-dgray">Use this page to order a package of total compensation statements, depending on the number of employees you have. <strong>If you have any questions while setting up your COMPackage account, feel free to contact us any time at <a href="mailto:support@compackage.com" class="text-greendarkclr underline">support@compackage.com</a></strong>.</p>
                    <h2 class="pb-5 text-xl text-greendarkclr font-bold">Choose Your Total Compensation Software Package and Enter Payment Information</h2>
                    
                    
                    <!--
                        1. Stripe Key.
                        2. Client intent object.
                    -->

                    {{-- <webapp-purchaseform 
                        :stripekey="'{{ env('STRIPE_KEY') }}'" 
                        :googlerecaptchakey="'{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}'" 
                        :stripeintent="'{{ $intent->client_secret }}'"
                        :pplansbyyear="{{ json_encode($plansByYear) }}"
                        :industries="{{$industries->toJson()}}"
                        :user="{{ (auth()->user()) ? auth()->user()->toJson() : null}}"
                        :company="{{ (auth()->user()) ? auth()->user()->defaultCompany() : null}}"
                    ></webapp-purchaseform> --}}
                    <webapp-purchaseform 
                        :stripekey="{{ json_encode(env('STRIPE_KEY')) }}" 
                        :googlerecaptchakey="{{ json_encode(env('GOOGLE_RECAPTCHA_SITE_KEY')) }}" 
                        :stripeintent="{{ json_encode($intent->client_secret) }}"
                        :pplansbyyear="{{ json_encode($plansByYear) }}"
                        :industries="{{ json_encode($industries) }}"
                        :user="{{ auth()->check() ? json_encode(auth()->user()) : 'null' }}"
                        :company="{{ auth()->check() ? json_encode(auth()->user()->defaultCompany()) : 'null' }}"
                    ></webapp-purchaseform>


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

@section('styles')
<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
    .coupon_total_price {
        padding-block: 15px;
    }
    .coupon_total_price th {
        text-align: left;
        padding-right: 8px;
        font-weight: 500;
        text-wrap: nowrap;
    }

    .coupon_total_price table {
        font-size: 14px;
    }

    .coupon_total_price tr {
        vertical-align: baseline;
    }
    .coupon_remove {
        cursor: pointer;
        padding-left: 10px;
        color:#ff6600;
    }
    .coupon_remove:hover {
        color: #16612e;
    }
</style>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
@endsection