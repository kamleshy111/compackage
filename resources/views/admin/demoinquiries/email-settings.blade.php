@extends('layouts.admin')

@section('content')
    {{-- Show all companies form PATH:components/admin/demoinquiries/emailsettings.vue --}}
            <div class="admindashboard-container">
                <div class="mb-10 flex flex-wrap items-end">
                    <h1 class="text-2xl text-black mr-2">Demo Inquiries</h1><small>(<em>Prospective customers</em>)</small>
                </div>
                <admin-demoinquiries-emailsettings :industries="{{json_encode($industries)}}"></admin-demoinquiries-emailsettings>
            </div>    
@endsection


