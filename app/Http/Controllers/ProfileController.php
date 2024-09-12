<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit');
    }

    public function show(): View
    {
        return view('profile.show');
    }
}
