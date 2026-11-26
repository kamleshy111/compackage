@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1 class="text-2xl text-black mb-8">{{ __('Dashboard') }}</h1></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!--{{ __('You are in Admin section!') }}-->
                </div>
            </div>
        </div>
    </div>
    <admin-dashboard></admin-dashboard>
</div>
@endsection
