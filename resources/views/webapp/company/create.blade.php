@extends('layouts.company')

@section('content')
    {{-- Create Company form PATH:components/webapp/comapny/CreateCompany.vue --}}
            <div class="dashboard-container">
                <company-create :permissions="{{json_encode($permissions)}}"></company-create>
            </div>    
@endsection
