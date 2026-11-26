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
    <!-- Fonts -->
    <link href="{{ asset('css/fonts.googleapis.com.css') }}" rel="stylesheet">
    <link href="{{ asset('css/db.onlinewebfonts.com.css') }}" rel="stylesheet">


    <!-- Styles -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
  // It's best to inline this in `head` to avoid FOUC (flash of unstyled content) when changing pages or themes
  /*if (
    localStorage.getItem('color-theme') === 'dark' ||
    (!('color-theme' in localStorage) &&
      window.matchMedia('(prefers-color-scheme: dark)').matches)
  ) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }*/
</script>
@yield('styles')
</head>

<body class="overflow-x-hidden">
    <div id="app" class="bg-white dark:bg-gray-700">
    <div class="comalert-error z-30 fixed max-w-xs w-full bg-red-400 text-white font-bold text-base border-l-4 border-solid border-l-red-600 -right-full top-2.5 p-2.5 transition-all duration-1000">
            This is alert
        </div>
        <div
            class="comalert-success z-30 fixed max-w-xs	w-full bg-green-400 text-white font-bold text-base border-l-4 border-solid border-l-green-600 -right-full top-20 p-2.5 transition-all duration-1000">
            This is alert
        </div>

        

        <header class="border-b relative z-20 bg-white dark:bg-gray-700">
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
                                    <a href="{{ route('login') }}"
                                        class="flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">
                                        <span>{{ __('Login') }}</span>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="w-full flex flex-wrap justify-end items-center mb-3">
                            <!-- Dark mode switcher 
                            <button id="theme-toggle" type="button"class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-sm p-2.5">
                                <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                                <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            Dark mode switcher end -->

                                <span class="mr-2.5 text-black">{{ auth()->user()->firstname }}</span>

                                <a href="#"
                                    class="text-lg bg-greenclr text-white hover:bg-greendarkclr rounded-full w-12 h-12 p-3 flex items-center justify-center transition ease-in-out delay-150">
                                    @php
                                        if (!empty(auth()->user()->firstname) && !empty(auth()->user()->lastname)) {
                                            echo substr(auth()->user()->firstname, 0, 1) . substr(auth()->user()->lastname, 0, 1);
                                        } else {
                                            echo substr(auth()->user()->name, 0, 1);
                                        }
                                    @endphp
                                </a>
                            </div>
                            <div class="w-full flex justify-end items-end">
                                <div class="">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
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
                <div class="aside-bar duration-500 sticky bg-gray-50 top-0 top-[104px] h-[100vh] z-10 w-14 lg:w-64 dark:bg-gray-900" aria-label="Sidebar">
                    <webapp-admin-sidebar></webapp-admin-sidebar>
                </div>
                <div id="main-content"
                    class="lg:w-[calc(100%_-_16rem)] w-[calc(100%_-_4rem)] py-4 lg:px-16 px-4 h-full lg:ml-0 lg:mt-0 ml-16 -mt-[100vh]">
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="dark:border-gray-900 border-t py-4 px-2.5">
            <div class="container mx-auto">
                <div class="row flex flex-wrap">
                    <div class="w-full text-center text-black text-xs px-4 dark:text-white"><strong>Copyright &copy; 2023</strong> All rights reserved.</div>
                </div>
            </div>
        </footer>

    </div>
    @yield('scripts')
</body>

</html>
