<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return redirect()->intended('login')->with('success', "You have successfully created your account. Please login to continue.");
    }
}
