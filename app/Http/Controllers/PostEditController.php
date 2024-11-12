<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostEditController extends Controller
{
    public function __invoke(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
}
