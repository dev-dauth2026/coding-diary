<?php

namespace App\Models;

use App\Observers\CommentObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'blog_post_id', 'content','parent_id'];


    public function replies(){
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Comment::class,'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function blogPost()
    {
        return $this->belongsTo(Post::class,'blog_post_id');
    }

    public function likes()
    {
        return $this->hasMany(Blog_Like::class,'comment_id');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured',1);
    }

    protected static function booted(): void
    {
        // Register the observer
        static::observe(CommentObserver::class);
    }
}
