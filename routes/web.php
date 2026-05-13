<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\BunpoController;
use App\Http\Controllers\KotobaController;
use App\Http\Controllers\KanjiController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/bunpo', [BunpoController::class, 'index'])->name('bunpo');
Route::get('/kotoba', [KotobaController::class, 'index'])->name('kotoba');
Route::get('/kanji', [KanjiController::class, 'index'])->name('kanji');
