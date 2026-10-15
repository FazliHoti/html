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
Route::put('/admin/games/{game}', [AdminGameController::class, 'update'])->middleware('auth')->name('admin.games.update');
Route::delete('/admin/games/{game}', [AdminGameController::class, 'destroy'])->middleware('auth')->name('admin.games.destroy');
Route::get('/admin', [AdminGameController::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');
Route::get('/admin/game-files', [AdminGameController::class, 'gameFiles'])->middleware('auth')->name('admin.game-files');
Route::put('/admin/game-files', [AdminGameController::class, 'updateGameFile'])->middleware('auth')->name('admin.game-files.update');
Route::put('/admin/content', [AdminGameController::class, 'updateContent'])->middleware('auth')->name('admin.content.update');
Route::post('/admin/categories', [AdminGameController::class, 'storeCategory'])->middleware('auth')->name('admin.categories.store');
Route::put('/admin/categories/{category}', [AdminGameController::class, 'updateCategory'])->middleware('auth')->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [AdminGameController::class, 'destroyCategory'])->middleware('auth')->name('admin.categories.destroy');
