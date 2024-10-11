<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileViewController extends Controller
{
    public function __invoke(User $user)
    {
        $posts = $user->posts()->with('user')->withCount('comments')->latest()->paginate(10);
        $totalComments = $user->comments()->count();
        return view('profile.show', compact('user', 'posts', 'totalComments'));
    }
}
