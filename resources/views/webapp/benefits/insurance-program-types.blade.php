@extends('layouts.company')

@section('content')
    {{-- Show all companies form PATH:components/webapp/benefits/insuranceProgramTypes.vue --}}
            <div class="dashboard-container">
                <div class="mb-10">
                    <h1 class="text-2xl text-black mb-2">Insurance Program Types</h1>
                    <p class="cpation text-black text-base">This is where you can set up and manage the census information for insurance benefits if you are using the product manually and not the Employee Loader. Once you save these, when you select the relevant calculator, and then select 'Census' you'll see these defaults there.</p>
                </div>
                <benefits-insurancetypes :permissions="{{json_encode($permissions)}}"></benefits-insurancetypes>
            </div>    
@endsection
