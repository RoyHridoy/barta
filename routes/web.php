<?php

use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'index' );
} );

Route::get( '/login', function () {
    return view( 'auth.login' );
} );

Route::get( '/register', function () {
    return view( 'auth.register' );
} );

Route::get( '/profile', function () {
    return view( 'profile.show' );
} );

Route::get( '/edit-profile', function () {
    return view( 'profile.edit' );
} );
