@extends('layouts.public')

@section('content')
<div class="container px-3.5 mx-auto">
    <div class="row flex flex-wrap items-center justify-center">
        <div class="max-w-xl w-full">
            <!-- <p style="text-align: center;color: #ffffff;font-size: 20px;background: #ff6600;padding: 10px;margin-bottom: 15px;box-shadow: 0px 2px 8px 0px #a3a2a2;"><strong>COMPackage 2.0 is down for maintenance while we bring you the next version - COMPackage 3.0! We will be back up with COMPackage 3.0 by 9:00 a.m. ET.</strong> </p> -->
            <div class="bg-white login-area px-8 py-7 shadow-lg rounded-md test123">
                <div class="text-3xl text-center text-black mb-5">{{ __('Login to Dashboard') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        @if( ! empty( $errors->all() ) ) 
                            @foreach ($errors->all() as $error)
                                <div class="text-red-700">{{ $error }}</div>
                            @endforeach
                        @endif

                        <div class="row mb-3">
                            <div class="w-full mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                                <input id="email" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-9 px-2.5 rounded bg-neutral-100 w-full form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                
                                @error('email')
                                    <span class="text-[15px] text-red-600 invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <input id="password" type="password" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-9 px-2.5 rounded bg-neutral-100 w-full form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="text-[15px] text-red-600 invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row flex mb-0">
                            <div class="w-1/2">
                                <button type="submit" class="flex items-center justify-center rounded-lg px-4 py-2.5 leading-4 text-center hover:menu-green gradient-green text-white font-sans font-bold text-lg">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="w-1/2 flex items-center justify-end">
                                @if (Route::has('password.request'))
                                    <a class="text-red-600 hover:text-red-700 font-bold text-xs" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
