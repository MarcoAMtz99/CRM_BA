<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\ApiController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::delete('users/{id}', [UserController::class,'destroy']); 
Route::put('users/{id}', [UserController::class,'update']); 
Route::get('/consultar-api', 'ApiController@consultarAPI');