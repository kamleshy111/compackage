@extends('layouts.company')

@section('content')
  <div class="dashboard-container">
      <h1 class="text-2xl text-black mb-8">Change Password</h1>
      <p class="text-black text-base mb-6">For security reasons, it is highly recommended that you change your password when you initially log on to the COMPackage system and change it periodically thereafter.</p>
      <p class="text-black text-base mb-3 underline">Suggestions for choosing a good password:</p>
      <webapp-change-pass></webapp-change-pass>
  </div>  
@endsection