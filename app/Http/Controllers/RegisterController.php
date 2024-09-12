<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('auth.register');
    }

    public function store(UserProfileRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()->route('login')->with('success', "You have successfully created your account. Please login to continue.");
    }
}
