<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Canonical Tag Link -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/global-custom-user.js') }}" type="text/javascript" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://www.youtube.com/player_api" defer></script>
    <!-- <script src="https://www.youtube.com/player_api"></script> -->
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fonts -->
    <link href="{{ asset('css/fonts.googleapis.com.css') }}" rel="stylesheet">
    <link href="{{ asset('css/db.onlinewebfonts.com.css') }}" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="overflow-x-hidden">
    <div id="app">
        <div class="comalert-error z-30 fixed max-w-xs w-full bg-red-400 text-white font-bold text-base border-l-4 border-solid border-l-red-600 -right-full top-2.5 p-2.5 transition-all duration-1000">
            This is alert
        </div>
        <div class="comalert-success z-30 fixed max-w-xs	w-full bg-green-400 text-white font-bold text-base border-l-4 border-solid border-l-green-600 -right-full top-20 p-2.5 transition-all duration-1000">
            This is alert
        </div>
        <header class="border-b relative z-20 bg-white">
        	<div class="px-3.5 mx-auto py-3.5 bgblack">
                <div class="row flex flex-wrap items-center gap-y-3">
                    <div class="md:w-7/12 w-3/5	pr-2 md:px-4">
                    <a href="{{ route('home') }}">
                    	<img src="{{ asset('images/logo.png') }}" alt="Compackage" />
                    </a>
                    </div>
                    <div class="md:w-5/12 w-2/5 pl-2 md:px-4 flex flex-wrap justify-end items-center">
                        @guest
                            <div class="w-full flex justify-end items-center">
                                <div class="">
                                    <a href="{{ route('login') }}" class="flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">
                                        <span>{{ __('Login') }}</span>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="w-full flex flex-wrap justify-end items-center mb-3">
                                <span class="mr-2.5 text-black">{{auth()->user()->firstname}}</span>
                                
                                <a href="#" class="text-lg bg-greenclr cursor-auto text-white rounded-full w-12 h-12 p-3 flex items-center justify-center transition ease-in-out delay-150">
                                    @php
                                        if( ! empty(auth()->user()->firstname) && ! empty(auth()->user()->lastname) ) {
                                            echo substr( auth()->user()->firstname, 0, 1 ).substr( auth()->user()->lastname, 0, 1 );
                                        } else {
                                            echo substr( auth()->user()->name, 0, 1 );
                                        }
                                    @endphp
                                </a>
                            </div>
                            <div class="w-full hidden md:flex justify-end items-end company-header">
                                {{-- Shows the all companies of a user and selects current company --}}
                                <header-user-company-information 
                                    :companies="{{json_encode($logged_user_companies)}}"
                                    :selected_company="{{! empty(request()->session()->get('user_permissions.current_user_company_id')) ? request()->session()->get('user_permissions.current_user_company_id') : '0'}}"
                                ></header-user-company-information>

                                <div class="">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                	</div>
            	</div>
            </div>
        </header>
        <main class="">
            <div class="flex flex-wrap">
                <div class="aside-bar duration-500 sticky bg-gray-50 top-0 top-[104px] h-[100vh] z-10 w-14 lg:w-64" aria-label="Sidebar">
                    @if(auth()->user())
                        <webapp-sidebar plan="{{! empty(auth()->user()->defaultCompany()) ? auth()->user()->defaultCompany()->getActivePlan() : 0}}" :lic_pack="{{auth()->user()->defaultCompanyLicencePackage()}}" :isresubscribed="{{auth()->user()->isResubscribed()}}"></webapp-sidebar>
                    @else
                        <webapp-sidebar></webapp-sidebar>
                    @endif
                </div>
                <div id="main-content" class="lg:w-[calc(100%_-_16rem)] w-[calc(100%_-_4rem)] py-4 lg:px-16 px-4 h-full lg:ml-0 lg:mt-0 ml-16 -mt-[100vh]">             
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="border-t py-4 px-2.5">
            <div class="container mx-auto">
                <div class="row flex flex-wrap">
                    <div class="w-full text-center text-black text-xs px-4">Copyright 2023 COMPackage Corp. PO Box 152 Presto PA, 15142 (833) 468-7674 - <a href="{{ route('webapp.supportrequest') }}" class="text-redclr">Support Request Form</a></div>
                </div>
            </div>
       </footer>
    </div>
    @yield('scripts')
</body>
</html>
