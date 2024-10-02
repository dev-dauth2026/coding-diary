<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'email',
        'phone_number',
        'address',
        'website',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'youtube_link',
    ];
}
