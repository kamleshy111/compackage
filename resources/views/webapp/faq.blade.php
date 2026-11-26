@extends('layouts.company')

@section('content')
  <div class="dashboard-container">
      <h1 class="text-2xl text-black mb-8">Frequently Asked Questions</h1>
      <p class="text-black text-base mb-1">To view the answer to a question, please click on the question.</p>
      <p class="text-black text-base mb-6">Re-click on the question again to hide the answer.</p>
      <webapp-faq></webapp-faq>
      
  </div>  
@endsection