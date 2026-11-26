@extends('layouts.admin')

@section('content')
    {{-- Show all companies form PATH:components/webapp/employees/index.vue --}}
            <div class="dashboard-container">
                <div class="mb-10">
                    <h1 class="text-2xl text-black mb-2">Employees</h1>
                </div>
                <admin-employee-index :users="{{json_encode($users)}}"></admin-employee-index>
            </div>    
@endsection
