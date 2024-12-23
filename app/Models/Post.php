<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use App\Notifications\PostLiked;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use Likeable;

    protected $fillable = [
        'barta', 'views', 'likes', 'photo',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }


    public function toggleLike(User $user)
    {
        if ($this->likedBy($user)) {
            $this->removeLike($user);
        } else {
            $this->addLike($user);
            $this->author->notify(new PostLiked($this));
        }
    }
}
