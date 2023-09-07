<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/test', function () {
    return view('test');
});
Auth::routes(["register" => false]);

Route::get('/campañas', [App\Http\Controllers\CampaignController::class, 'index'])->name('campaign');
Route::get('/consulta', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager');




