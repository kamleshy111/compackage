<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** CRUD operations for the company in the Reseller section. Only reseller have permission to add or remove the companies */
Route::controller(App\Http\Controllers\CompanyController::class)->middleware('auth')->group(function () {
    
    Route::get('/companies', 'indexAPI');
    Route::get('/user/{id}/companies', 'getCompaniesByUserAPI');
});