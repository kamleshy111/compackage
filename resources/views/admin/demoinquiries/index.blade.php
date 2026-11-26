@extends('layouts.admin')

@section('content')
    {{-- Show all companies form PATH:components/admin/demoinquiries/index.vue --}}
            <div class="admindashboard-container">
                <div class="mb-10 flex flex-wrap items-end">
                    <h1 class="text-2xl text-black mr-2">Demo Inquiries</h1><small>(<em>Prospective customers</em>)</small>
                </div>
                <admin-demoinquiries-index :industries="{{json_encode($industries)}}"></admin-demoinquiries-index>
            </div>    
@endsection
