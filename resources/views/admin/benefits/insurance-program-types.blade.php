@extends('layouts.admin')

@section('content')
    {{-- Show all companies form PATH:components/webapp/benefits/insuranceProgramTypes.vue --}}
            <div class="dashboard-container">
                <div class="mb-10">
                    <h1 class="text-2xl text-black mb-2">Insurance Program Types</h1>
                    <p class="cpation text-black text-base">This is where you can setup and manage the census information for insurance benefits</p>
                </div>
                <benefits-insurancetypes></benefits-insurancetypes>
            </div>    
@endsection
