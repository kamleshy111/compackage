@extends('layouts.company')

@section('content')
    {{-- Show all companies form PATH:components/webapp/benefits/Index.vue --}}
            <div class="dashboard-container">
                <div class="mb-4">
                    <h1 class="text-2xl text-black mb-2">Benefits</h1>
                    <p class="mb-3 cpation text-black text-base">Select all benefits that exist for any single employee throughout your company by checking the box to the left. If unchecked, that benefit will be ignored.</p>
                    <p class="mb-3 cpation text-black text-base">Also click the Co-Pay Benefit box if there is a co-payment from the employee (in some cases, e.g., Aflac, these might be paid entirely by the employee). Note: the left-side employer checkbox must be checked even if there is no employer contribution in order for the employee contribution to appear.</p>
                    <p class="mb-3 cpation text-black text-base">Click Save (at the top or bottom of the screen) before leaving this page to save your changes.</p>
                </div>
                <benefits-index :permissions="{{json_encode($permissions)}}"></benefits-index>
            </div>    
@endsection
