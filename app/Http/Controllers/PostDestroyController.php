<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostDestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        if ($post->image) {
            unlink('storage/' . $post->image);
        }
        $post->delete();
        return redirect()->intended()->with('success', 'You have successfully deleted the post');
    }
}
