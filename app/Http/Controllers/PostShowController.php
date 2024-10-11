<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->loadCount('comments')->load('comments.user', 'user');
        return view('posts.show', compact('post'));
    }
}
