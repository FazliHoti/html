<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Blog.index', ['title' => 'Field Notes | Stories for the curious']);
})->name('home');

Route::view('/about', 'Blog.about', [
    'title' => 'About | Field Notes',
])->name('about');

Route::view('/contact', 'Blog.contact', [
    'title' => 'Contact | Field Notes',
])->name('contact');
