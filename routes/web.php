<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get( '/', HomeController::class );

Route::get( '/login', [LoginController::class, 'index'] )->name( 'login' );
Route::post( '/login', [LoginController::class, 'store'] );

Route::get( '/register', [RegisterController::class, 'index'] )->name( 'register' );
Route::post( '/register', [RegisterController::class, 'store'] );

Route::middleware( ['auth'] )->group( function () {
    Route::get( 'profile', [ProfileController::class, 'show'] );
    Route::get( 'edit-profile', [ProfileController::class, 'edit'] );
} );
