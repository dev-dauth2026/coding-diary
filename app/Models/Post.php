<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function categories():BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function favouriteBy():BelongsToMany
    {
        return $this->belongsToMany(User::class,'favourite_blogs','blog_post_id', 'user_id')->as('favorite')->withTimestamps();
    }


    public function comments()
    {
        return $this->hasMany(Comment::class,'blog_post_id');
    }

    public function likes(){
        return $this->hasMany(Blog_Like::class,'blog_post_id');
    }

    public static function getStatusOptions()
    {
        // Use the table name dynamically from the model
        $tableName = (new self)->getTable(); 

        // Properly format the raw SQL query string
        $statusColumn = DB::select("SHOW COLUMNS FROM `{$tableName}` WHERE Field = 'status'");

        // Ensure the result is not empty
        if (empty($statusColumn)) {
            return [];
        }

        // Extract the enum options from the 'Type' property
        $type = $statusColumn[0]->Type;

        // Use regex to get the enum values from the string
        preg_match('/^enum\((.*)\)$/', $type, $matches);

        // Initialize an empty array for the enum values
        $enum = [];

        // Iterate over the matches and trim the quotes
        foreach (explode(',', $matches[1]) as $value) {
            $enum[] = trim($value, "'");
        }

        return $enum;
    }

 
}
