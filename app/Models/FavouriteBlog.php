<?php

namespace App\Models;

use App\Observers\FavouriteBlogObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteBlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blog_post_id',
        
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function post(){
        return $this->belongsTo(Post::class,'blog_post_id');
    }
    protected static function booted(): void
    {
        // Register the observer
        static::observe(FavouriteBlogObserver::class);
    }
}
