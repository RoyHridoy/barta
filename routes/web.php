<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\PostDestroyController;
use App\Http\Controllers\PostEditController;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\PostStoreController;
use App\Http\Controllers\PostUpdateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::delete('logout', LogoutController::class)->name('logout');
    Route::patch('edit-profile', [ProfileController::class, 'update']);
    Route::get('change-password', [PasswordChangeController::class, 'index'])->name('password-change');
    Route::put('change-password', [PasswordChangeController::class, 'update']);
});

Route::post('posts', PostStoreController::class)->middleware('auth')->name('posts.store');
Route::get('posts/{post}/edit', PostEditController::class)->middleware('auth')->can('edit','post')->name('posts.edit');
Route::get('posts/{post}', PostShowController::class)->name('posts.show');
Route::patch('posts/{post}', PostUpdateController::class)->middleware('auth')->can('edit','post')->name('posts.update');
Route::delete('posts/{post}', PostDestroyController::class)->middleware('auth')->can('delete','post');
