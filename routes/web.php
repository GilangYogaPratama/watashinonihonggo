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
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ParagraphController;
use App\Http\Controllers\KanaController;
use App\Http\Controllers\N3KanjiController;
use App\Http\Controllers\KanjiGameController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/bunpo', [BunpoController::class, 'index'])->name('bunpo');
Route::get('/kotoba', [KotobaController::class, 'index'])->name('kotoba');
Route::get('/kanji', [KanjiController::class, 'index'])->name('kanji');
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
Route::get('/reading', [ParagraphController::class, 'index'])->name('reading');
Route::get('/kana', [KanaController::class, 'index'])->name('kana');

// N3 Section Routes
Route::get('/n3/kanji', [N3KanjiController::class, 'index'])->name('n3.kanji');
Route::get('/n3/kotoba', [App\Http\Controllers\KotobaController::class, 'indexN3'])->name('n3.kotoba');
Route::get('/n3/bunpo', [App\Http\Controllers\BunpoController::class, 'indexN3'])->name('n3.bunpo');
Route::get('/n3/input', [N3KanjiController::class, 'create'])->name('n3.input');
Route::post('/n3/input', [N3KanjiController::class, 'store'])->name('n3.input.store');
Route::get('/n3/quiz', [N3KanjiController::class, 'quiz'])->name('n3.quiz');

// Game Routes (Tebak & Cocok - Onyomi/Kunyomi)
Route::get('/game/tebak/{level}/{type}', [KanjiGameController::class, 'tebak'])->name('game.tebak');
Route::get('/game/cocok/{level}/{type}', [KanjiGameController::class, 'cocok'])->name('game.cocok');
