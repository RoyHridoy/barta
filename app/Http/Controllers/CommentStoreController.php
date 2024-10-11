<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentStoreController extends Controller
{
    public function __invoke(CommentRequest $request, Post $post)
    {
        auth()->user()->comments()->create([
            'body' => $request->input('body'),
            'post_id' => $post->id
        ]);
        return redirect()->back();
    }
}
