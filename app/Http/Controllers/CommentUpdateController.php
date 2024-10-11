<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentUpdateController extends Controller
{
    public function __invoke(CommentRequest $request, Post $post, Comment $comment)
    {
        $comment->update($request->validated());
        return redirect()->back();
    }
}
