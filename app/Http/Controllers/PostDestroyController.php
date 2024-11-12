<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostDestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
