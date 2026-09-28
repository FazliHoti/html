<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::query()
        ->where('is_published', true)
        ->orderByDesc('is_featured')
        ->orderBy('sort_order')
        ->latest('published_at')
        ->get();

    return view('Blog.index', compact('posts'));
})->name('home');

Route::view('/about', 'Blog.about')->name('about');

Route::view('/contact', 'Blog.contact')->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.posts.index'))->name('index');
    Route::resource('posts', PostController::class)->except('show');
});

require __DIR__.'/auth.php';
