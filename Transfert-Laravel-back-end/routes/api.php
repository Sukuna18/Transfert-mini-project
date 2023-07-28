<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/clients', 'App\Http\Controllers\ClientController@index');
Route::get('/clients/{client}', 'App\Http\Controllers\ClientController@show');
Route::get('/comptes', 'App\Http\Controllers\CompteController@index');
Route::get('/comptes/{compte}', 'App\Http\Controllers\CompteController@show');