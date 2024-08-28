<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_type',
        'description',
        'subject_type',
        'subject_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function getIconAttribute()
    {
        $icons = [
            'login' => 'fas fa-sign-in-alt',
            'logout' => 'fas fa-sign-out-alt',
            'profile_update' => 'fas fa-user-edit',
            'post_created' => 'fas fa-pencil-alt',
            'liked' => 'fas fa-thumbs-up text-success',
            'disliked' => 'fa-solid fa-thumbs-down text-secondary',
            'saved_favorite' => 'fa-solid fa-heart text-danger',
            'removed_favorite' => 'fa-solid fa-heart-crack text-danger',
            'comment_added' => 'fas fa-comment',
            'password_changed' => 'fas fa-key',
            'settings_updated' => 'fas fa-cog',
            'account_deactivated' => 'fas fa-user-slash',
        ];

        return $icons[$this->activity_type] ?? 'fas fa-info-circle'; // Default icon if type not found
    }

}
