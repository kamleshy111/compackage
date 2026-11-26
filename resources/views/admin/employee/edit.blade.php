@extends('layouts.admin')

@section('content')
    {{-- Show all companies form PATH:components/webapp/employees/Edit.vue --}}
            <div class="dashboard-container">
                <div class="mb-10">
                    <h1 class="text-2xl text-black mb-2">Employees Edits</h1>
                </div>
                <admin-employee-edit :edit_employee="{{json_encode($employee)}}" :company="{{json_encode($company)}}"></admin-employee-edit>
            </div>    
@endsection