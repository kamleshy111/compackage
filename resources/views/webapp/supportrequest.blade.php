@extends('layouts.company')

@section('content')
  <div class="dashboard-container">
      <h1 class="text-2xl text-black mb-8">Support Request Form</h1>
      <webapp-request-form :user="{{json_encode($user)}}" :company_id="{{$company_id}}"></webapp-request-form>
  </div>  
@endsection