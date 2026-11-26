@extends('layouts.company')

@section('content')
  <div class="dashboard-container">
      <h1 class="text-2xl text-black mb-8">Annual Refresh Button</h1>
      <p class="text-black text-base mb-3">The annual refresh button is used to enable you to clear data from the prior year. Once you press it, it will mark all your employees as not committed. You can then delete some or all of them to make more space. If you think you've deleted everything but you still can't upload as many employees as your license allows, click View Census (in the Employees tab) to see if you have additional employees marked as Inactive. If so, delete these as well. </p>
      <p class="text-black text-base mb-3">This button is only enabled for clients that have a multi-year license, or any client that resubscribes.
It will be enabled after resubscribing, or on the first day of the next year of the plan, if you purchased a multi-year license.</p>      
      <div class="flex">
        @if( $show_button )
          <input 
            type="submit"
            class="clear-all-data-annual-button mr-3 cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm"
            value="Mark All Employees as Not Committed"
          >
        @else
          <p class="text-red-700 text-base mb-6">The data is already cleared for this year. The button will show first day of next year if applicable.</p>
        @endif
      </div>
  </div>  
@endsection

@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    jQuery(document).ready(function() {
      jQuery(".clear-all-data-annual-button").click(function() {
        axios.get( "{{url('/webapp/anuual-refresh-clear-data')}}").then( (response) => {
          if( response.data.success ) {
            showSuccessMessage(response.data.data.msg);
            setTimeout(()=> {location.reload()}, 3000);
          }
        }).catch( (error) => {
            showErrorMessage(response.data.data.msg);
        });
      });
    });
  </script>
@endsection