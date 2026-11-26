@extends('layouts.admin')

@section('content')
    
    {{-- 
        Create Company form PATH:components/webapp/comapny/CreateCompany.vue
        Permissions for the current routes
    --}}
    <div class="dashboard-container">
        <admin-company-edit :editcompany="{{json_encode($company)}}"></admin-company-edit>
    </div>    
@endsection