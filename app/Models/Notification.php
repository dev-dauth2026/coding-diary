<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'notifiable_id',
        'notifiable_type',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array', // To automatically cast the data field to an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'notifiable_id');
    }
}
