<?php

use App\Livewire\PostEdit;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('posts/{post}/edit', PostEdit::class)->name('posts.edit');
});

Route::view('edit-profile', 'profile')->middleware(['auth'])->name('edit-profile');

require __DIR__.'/auth.php';
