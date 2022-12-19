<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);;
});

Route::resource('companies', App\Http\Controllers\CompaniesController::class);
Route::resource('jobs', App\Http\Controllers\JobsController::class);
Route::resource('plans', App\Http\Controllers\PlansController::class);
Route::resource('job_types', App\Http\Controllers\JobTypesController::class);
Route::resource('apply', App\Http\Controllers\ApplyController::class);
Route::resource('users', App\Http\Controllers\UsersController::class);
