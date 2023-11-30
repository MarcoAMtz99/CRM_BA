<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ClientController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(["register" => false]);


Route::middleware(['auth'])->group(function () {
  
Route::get('/campañas', [App\Http\Controllers\CampaignController::class, 'index'])->name('campaign');
Route::get('/campañas/detalle/{id}', [App\Http\Controllers\CampaignController::class, 'getCampaign'])->name('getCampaign');
Route::get('/consulta', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager');



Route::post('/generate-link', [App\Http\Controllers\ManagerController::class, 'encryptJson'])->name('link');
// Users
Route::resource('users', UserController::class);
Route::get('/links-history', [UserController::class, 'usersHistory'])->name('linksHistory');

//Importar csv
Route::post('/import-csv', [ImportController::class, 'importCSV']);
Route::get('/import-clients', [ImportController::class, 'form'])->name('importClients');
//Exportar csv 
Route::get('/export-clients', [ExportController::class, 'exportClientsView'])->name('importClientsView');
Route::post('/export-clients', [ExportController::class, 'exportClients'])->name('exportClients');

//Clientes 
Route::get('/local/clients', [ClientController::class, 'getClientsView'])->name('getClientsView');




});

