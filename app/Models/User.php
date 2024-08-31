<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function favouriteBlogs(){
        return $this->hasMany(FavouriteBlog::class,'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function likes()
    {
        return $this->hasMany(Blog_Like::class,'user_id');
    }

    public function notification()
    {
        return $this->hasMany(Notification::class,'user_id');
    }

    public function watchedBlog()
    {
        return $this->hasMany(WatchedBlog::class,'user_id');
    }

}
