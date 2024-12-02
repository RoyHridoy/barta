<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'welcome')->name('home');
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::view('edit-profile', 'profile')->middleware(['auth'])->name('edit-profile');

require __DIR__.'/auth.php';
