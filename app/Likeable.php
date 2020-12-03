<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Likeable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select post_id, sum(liked) likes, sum(!liked) dislikes from likes group by post_id',
            'likes',
            'likes.post_id',
            'posts.id'
        );
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate(
        [
            'user_id' => $user ? $user->id : auth()->id(),
        ],
        [
            'liked' => $liked
        ]);
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()
            ->where('user_id', $user->id)
            ->where('liked', true)
            ->exists();
    }

    public function isDislikedBy(User $user)
    {
        return $this->likes()
            ->where('user_id', $user->id)
            ->where('liked', false)
            ->exists();
    }
}
