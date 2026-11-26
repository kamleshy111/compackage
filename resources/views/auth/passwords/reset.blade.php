@extends('layouts.public')

@section('content')
<div class="container px-3.5 mx-auto">
    <div class="row flex flex-wrap items-center justify-center">
        <div class="max-w-xl w-full">
            <div class="bg-white login-area px-8 py-7 shadow-lg rounded-md">
                <div class="text-3xl text-center text-black mb-5">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <div class="w-full mb-3">
                                <label for="email" class="text-md-end block">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-9 px-2.5 rounded bg-neutral-100 w-full form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row flex mb-3 -mx-2.5">
                            <div class="w-full md:w-1/2 px-2.5">
                                <label for="password" class="block text-md-end">{{ __('Password') }}</label>
                                <input id="password" type="password" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-9 px-2.5 rounded bg-neutral-100 w-full form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-2.5">
                                <label for="password-confirm" class="block text-md-end">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-9 px-2.5 rounded bg-neutral-100 w-full form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        

                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="flex items-center justify-center rounded-lg px-4 py-2.5 leading-4 text-center hover:menu-green gradient-green text-white font-sans font-bold text-lg">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
