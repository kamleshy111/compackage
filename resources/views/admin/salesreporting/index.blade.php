@extends('layouts.admin')

@section('content')
    {{-- Show all companies form PATH:components/admin/salesreporting/index.vue --}}
    <div class="admindashboard-container">
        <div class="mb-10 flex items-end">
            <h1 class="text-2xl text-black mr-2">Sales Reporting</h1><small>(<em>Software sales</em>)</small>
        </div>
        <admin-salesreport-index :industries="{{ json_encode($industries) }}"></admin-salesreport-index>
    </div>    
@endsection
