<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Redis;

trait Likeable
{
    public function getLikeKey()
    {
        return sprintf('%s.%s.likes', $this->getTable(), $this->id);
    }

    public function addLike(User $user)
    {
        Redis::sadd($this->getLikeKey(), $user->id);
    }

    public function removeLike(User $user)
    {
        Redis::srem($this->getLikeKey(), $user->id);
    }

    public function getTotalLike()
    {
        return Redis::scard($this->getLikeKey());
    }

    public function likedBy(User $user)
    {
        return Redis::sismember($this->getLikeKey(), $user->id);
    }
}
