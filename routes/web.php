<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(["register" => false]);


Route::middleware(['auth'])->group(function () {
  
Route::get('/campañas', [App\Http\Controllers\CampaignController::class, 'index'])->name('campaign');
Route::get('/campañas/detalle/{id}', [App\Http\Controllers\CampaignController::class, 'getCampaign'])->name('getCampaign');
Route::get('/consulta', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager');

Route::get('/test', function () {
    return view('test');
});
});
