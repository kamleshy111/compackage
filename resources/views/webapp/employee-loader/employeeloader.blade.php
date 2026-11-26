@extends('layouts.company')

@section('content')
  <div class="dashboard-container">
      <h1 class="text-2xl text-black mb-8">Employee Loader</h1>
      <webapp-employee-loader :compackage_benefits="{{json_encode($compackage_benefits)}}" ></webapp-employee-loader>
  </div>  
@endsection