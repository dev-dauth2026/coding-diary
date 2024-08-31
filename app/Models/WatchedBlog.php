<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchedBlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blog_post_id',
        'viewed_at',
        'view_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
}
