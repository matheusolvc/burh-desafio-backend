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



Route::get('/', function () {
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);;
});

Route::resource('companies', App\Http\Controllers\CompaniesController::class);
Route::resource('jobs', App\Http\Controllers\JobsController::class);
Route::resource('plans', App\Http\Controllers\PlansController::class);
Route::resource('job_types', App\Http\Controllers\JobTypesController::class);
Route::resource('apply', App\Http\Controllers\ApplyController::class);
Route::resource('users', App\Http\Controllers\UsersController::class);

Route::post('/search', 'SearchController@filter');


// Route::get('/', function () {
//     return redirect('api');
// });


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
