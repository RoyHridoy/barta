<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function edit(User $user, Comment $comment): bool
    {
        return $user->is($comment->author);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->is($comment->author);
    }
}
