<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
