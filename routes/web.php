<?php

use App\Livewire\PostEdit;
use App\Livewire\PostShow;
use App\Livewire\ProfileStats;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'home')->name('home');
    Route::get('@{user:username}', ProfileStats::class)->name('profile.stats');
    Route::get('posts/{post}', PostShow::class)->name('posts.show');
    Route::get('posts/{post}/edit', PostEdit::class)->name('posts.edit')->can('edit', 'post');
});

Route::view('edit-profile', 'profile')->middleware(['auth'])->name('edit-profile');

require __DIR__.'/auth.php';
