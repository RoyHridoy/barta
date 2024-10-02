<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        $posts = Post::with('user')->latest()->paginate(6);
        return view('index', compact('posts'));
    }
}
