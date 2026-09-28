<?php

use App\Http\Controllers\AdminGameController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{slug}', [GameController::class, 'show'])->name('games.show');
Route::post('/games/{game}/favorite', [GameController::class, 'toggleFavorite'])->middleware('auth')->name('games.favorite');
Route::post('/games/{slug}/score', [GameController::class, 'storeScore'])->middleware('auth')->name('games.score');
Route::post('/games/{game}/review', [GameController::class, 'storeReview'])->middleware('auth')->name('games.review');
Route::get('/leaderboard', [GameController::class, 'leaderboard'])->name('leaderboard');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/admin/games', [AdminGameController::class, 'index'])->middleware('auth')->name('admin.games');
Route::post('/admin/games', [AdminGameController::class, 'store'])->middleware('auth')->name('admin.games.store');
Route::delete('/admin/games/{game}', [AdminGameController::class, 'destroy'])->middleware('auth')->name('admin.games.destroy');
