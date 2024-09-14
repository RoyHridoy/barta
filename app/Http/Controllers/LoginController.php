<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view( 'auth.login' );
    }

    public function authenticate( LoginRequest $request ): RedirectResponse
    {
        $remember = $request->input( 'rememberMe' ) ? true : false;

        if ( Auth::attempt( $request->validated(), $remember ) ) {
            $request->session()->regenerate();
            return redirect()->intended( route('home') );
        }

        return back()->withErrors( [
            'email' => "Credentials don't match. Try again with valid details",
        ] )->onlyInput( 'email' );
    }
}
