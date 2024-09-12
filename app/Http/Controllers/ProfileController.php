<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit');
    }

    public function show(): View
    {
        return view('profile.show');
    }

    public function update(UpdateUserProfileRequest $request)
    {
        dd($request->all());
        return "HELLO";
    }
}
