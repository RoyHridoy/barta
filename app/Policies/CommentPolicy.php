<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function edit(User $user, Comment $comment)
    {
        return $comment->user()->is($user);
    }

    public function delete(User $user, Comment $comment)
    {
        return $comment->user()->is($user);
    }
}
