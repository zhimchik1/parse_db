<?php

use App\Http\Controllers\DumpController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileSQLController;
use App\Http\Controllers\FileUploadSQLController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/import', [DumpController::class, 'import'])->name('import');
Route::post('/remove', [DumpController::class, 'remove'])->name('remove');
Route::post('/uploadSql', [FileUploadSQLController::class, 'upload'])->name('uploadSql');
Route::post('/export', [FileSQLController::class, 'export'])->name('export');
Route::get('/removeSQLFile', [FileSQLController::class, 'removeFile'])->name('removeSQLFile');
Route::get('/removeExport', [FileSQLController::class, 'removeExport'])->name('removeExport');
Route::get('/downloadExportFile', [FileSQLController::class, 'downloadExportFile'])->name('downloadExportFile');