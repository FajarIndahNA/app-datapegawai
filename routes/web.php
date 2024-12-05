<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

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

// Route::get('/dashboard', function () {
//     return view('layouts.master'); 
// });
Route::get('/', function () {
    return view('layouts.app'); 
});

Route::get('/pegawai/data', [PegawaiController::class, 'data'])->name('pegawai.data');
Route::resource('/pegawai', PegawaiController::class);
