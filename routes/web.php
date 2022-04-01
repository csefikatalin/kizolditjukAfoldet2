<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BejegyzesController;
use App\Http\Controllers\TevekenysegController;
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
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


/** Bejegyzések */
Route::get('/bejegyzesek', [BejegyzesController::class, 'index']);
Route::get('/bejegyzesek/{osztaly_id}', [BejegyzesController::class, 'osztaly']);
Route::post('/bejegyzes', [BejegyzesController::class, 'store']);

/**Tevekenységek */
Route::get('/tevekenysegek', [TevekenysegController::class, 'index']);


require __DIR__ . '/auth.php';
