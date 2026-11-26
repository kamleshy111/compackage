@extends('layouts.company')

@section('content')
            <div class="dashboard-container">
                <div class="">
                    <h1 class="text-2xl text-black mb-2">Utilities</h1>
                    <span class="cpation text-black text-base">This is where you can setup and manage the users who will have access to this company's data.</span>
                </div>
                
                
                <!-- "This is best place to send static or initial data to reduce axios ajax call"
                    users: sending the users from blade to vue for showing in the dropdown.
                    companies: showing list of companies in the user profile dropdown. -->
                <?php $user = auth()->user(); ?>
                <user-index :users="{{json_encode($users)}}" :companies="{{json_encode($companies)}}" :report_count="{{$reports_count}}" :logged_in_user="{{$user}}"></user-index>
            </div>    
@endsection