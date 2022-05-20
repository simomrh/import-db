<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ImportController;

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

Route::get('/improt', [\App\Http\Controllers\ImportController::class, 'getImport'])->name('import');
Route::post('/import_parse', [\App\Http\Controllers\ImportController::class, 'parseImport'])->name('import_parse');
Route::post('/import_process', [\App\Http\Controllers\ImportController::class, 'processImport'])->name('import_process');


//contact

Route::get('/contact_view', [\App\Http\Controllers\ContactController::class, 'create']);
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

//home

Route::get('/', [\App\Http\Controllers\ContactController::class, 'home']);
