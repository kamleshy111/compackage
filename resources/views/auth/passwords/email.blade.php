@extends('layouts.public')

@section('content')
<div class="container px-3.5 mx-auto">
    <div class="row flex flex-wrap items-center justify-center">
        <div class="max-w-xl w-full">
            <div class="bg-white login-area px-8 py-7 shadow-lg rounded-md">
                <div class="text-3xl text-center text-black mb-5">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="w-full mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-9 px-2.5 rounded bg-neutral-100 w-full form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="text-red-700 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="flex items-center justify-center rounded-lg px-4 py-2.5 leading-4 text-center hover:menu-green gradient-green text-white font-sans font-bold text-lg">
                                    {{ __('Send Password Reset Link') }}
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
