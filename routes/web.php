<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurmaController;
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

Route::get('file-import-export', [TurmaController::class, 'fileImportExport']);
Route::post('file-import', [TurmaController::class, 'fileImport'])->name('file-import');
Route::get('automatizando', [TurmaController::class, 'automatizarInsercao']);
Route::get('file-export', [TurmaController::class, 'fileExport'])->name('file-export');


Route::get('/', function () {
    return view('welcome');
});
