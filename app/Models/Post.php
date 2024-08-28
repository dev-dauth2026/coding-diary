<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'tags',
        'image',
        'author'
    ];

    public function favouriteBy(){
        return $this->belongsToMany(User::class,'favourite_blogs','blog_post_id', 'user_id')->withTimestamps();
    }

    public function favouriteBlog(){
        return $this->hasMany(FavouriteBlog::class,'blog_post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'blog_post_id');
    }

    public function likes(){
        return $this->hasMany(Blog_Like::class,'blog_post_id');
    }

 
}
