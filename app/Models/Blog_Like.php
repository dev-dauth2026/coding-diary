<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_Like extends Model
{
    use HasFactory;

    public function likes(){
        return $this->belongsTo(Comment::class);
    }
}
