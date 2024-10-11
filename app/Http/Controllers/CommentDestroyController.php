<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;

class CommentDestroyController extends Controller
{
    public function __invoke(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'You have successfully deleted the comment');
    }
}
