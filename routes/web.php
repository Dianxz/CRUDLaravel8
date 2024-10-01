<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployesController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pegawai' , [EmployesController::class, 'index'])->name('pegawai');

Route::get('/tambahdata' , [EmployesController::class, 'tambahdata'])->name('tambahdata');
Route::post('/inserdata' , [EmployesController::class, 'inserdata'])->name('inserdata');
Route::get('/tampildata/{id}' , [EmployesController::class, 'tampildata'])->name('tampildata');
Route::post('/updatedata/{id}' , [EmployesController::class, 'updatedata'])->name('updatedata');
Route::get('/delete/{id}' , [EmployesController::class, 'delete'])->name('delete');

// pdf
Route::get('/exportPdf' , [EmployesController::class, 'exportPdf'])->name('exportPdf');
// Export Excel
Route::get('/exportExcel' , [EmployesController::class, 'exportExcel'])->name('exportExcel');
// Import Excel
Route::post('/importExcel' , [EmployesController::class, 'importExcel'])->name('importExcelimportExcel');

