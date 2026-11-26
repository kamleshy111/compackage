@extends('layouts.public')

@section('content')
@if(empty($error_msg))
  <div class="container mx-auto px-3.5">
          <div class="row flex flex-wrap">
              <div class="w-full md:w-[60%] lg:w-[70%]">
                  <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-52 h-52">
                        <path class="text-greendarkclr" stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                      </svg>
                      You have successfully unsubscribed.
                    </h1>
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
  @else
    <div class="container mx-auto px-3.5">
        <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
          <h1 class="pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-redclr font-bold text-center">
            {{ $error_msg }}
          </h1>
        </div>
    </div>
  @endif
@endsection