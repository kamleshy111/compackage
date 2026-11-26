@extends('layouts.admin')

@section('content')
    {{-- Show all companies form PATH:components/admin/usermanager/index.vue --}}
            <div class="admindashboard-container">
                <div class="mb-10 flex flex-wrap items-end">
                    <h1 class="text-2xl text-black mr-2">User Manager</h1><small>(<em>View user information</em>)</small>
                </div>
                {{-- @php
                    $users = \App\Models\User::with('sales', 'metas', 'companies')->where('user_role', '!=', 1)->get();
                    dd($users);
                @endphp --}}
                
                <admin-user-index :industries="{{ json_encode($industries) }}"></admin-user-index>
            </div>    
@endsection
