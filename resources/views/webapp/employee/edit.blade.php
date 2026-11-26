@extends('layouts.company')

@section('content')
    <div class="dashboard-container">
        <div class="mb-2">
            <h1 class="text-2xl text-black mb-2">Employees Details</h1>
        </div>
        <employee-edit 
            :edit_employee="{{json_encode($employee)}}" 
            :company="{{auth()->user()->defaultCompanyAddress()->toJson()}}"
            :full_company="{{auth()->user()->defaultCompany()->toJson()}}"
            :social_security='{!! json_encode( config("constants.social_security") ) !!}'
        ></employee-edit>
    </div>    
@endsection