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
Route::apiResource('clients', 'App\Http\Controllers\ClientController');
Route::apiResource('comptes', 'App\Http\Controllers\CompteController');
Route::apiResource('transactions', 'App\Http\Controllers\TransactionController');
Route::get('/comptes/transaction/{numeroCompte}', ['App\Http\Controllers\CompteController', 'showByNumber']);
Route::get('/clients/transaction/{telephone}', ['App\Http\Controllers\ClientController', 'showByPhone']);
Route::get('/transactions/transaction/{expediteur_id}', ['App\Http\Controllers\TransactionController', 'getTransactionExp']);