@extends('layouts.company')

@section('content')
    
    {{-- 
        Create Company form PATH:components/webapp/comapny/CreateCompany.vue
        Permissions for the current routes
    --}}
    <div class="dashboard-container">
        <company-create :editcompany="{{json_encode($company)}}" :permissions="{{json_encode($permissions)}}"></company-create>
    </div>    
@endsection