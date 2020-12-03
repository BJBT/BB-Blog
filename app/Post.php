<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likeable;

    protected $guarded = [];

    protected $fillable = ['user_id', 'title', 'body'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('commentCount', function ($builder) {
            $builder->withCount('comments');
        });
    }

    public function path()
    {
        return "/posts/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function newComment($comment)
    {
        return $this->comments()->create($comment);
    }
}
