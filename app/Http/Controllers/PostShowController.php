<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostShowController extends Controller
{
    public function __invoke(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
