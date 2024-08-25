<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_Like extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','blog_post_id', 'comment_id'];


    public function blog_post(){
        return $this->belongsTo(Post::class,'blog_post_id');
    }
    public function likes(){
        return $this->belongsTo(Comment::class,'comment_id');
    }

     /**
     * Get the user who liked the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
