<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function index()
    {
        return view( 'auth.login' );
    }

    public function store()
    {
        return "Store Login Information";
    }
}
