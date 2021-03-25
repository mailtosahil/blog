<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title', 'slug', 'user_id', 'cover_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function isAuthUserLikedPost()
    {
        return $this->likes()->where('user_id',  auth()->id())->exists();
    }
}
