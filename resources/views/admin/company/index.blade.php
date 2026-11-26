@extends('layouts.admin')

@section('content')
    {{-- Show all companies form PATH:components/webapp/company/index.vue --}}
            <div class="dashboard-container">
                <div class="mb-10">
                    <h1 class="text-2xl text-black mb-2">Companies</h1>
                </div>
                <admin-company-index :users="{{json_encode($users)}}"></admin-company-index>
            </div>    
@endsection
