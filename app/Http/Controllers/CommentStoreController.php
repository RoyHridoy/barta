<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentStoreController extends Controller
{
    public function __invoke(CommentRequest $request, Post $post)
    {
        Comment::create([
            'body' => $request->input('body'),
            'user_id' => auth()->id(),
            'post_id' => $post->id
        ]);
        return redirect()->back();
    }
}
