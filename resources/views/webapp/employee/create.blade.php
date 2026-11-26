@extends('layouts.company')

@section('content')
    {{-- Create Company form PATH:components/webapp/comapny/CreateCompany.vue --}}
    <div class="dashboard-container">
        <employee-create :permissions="{{json_encode($permissions)}}" :company="{{auth()->user()->defaultCompanyAddress()->toJson()}}"></employee-create>
    </div>    
@endsection
