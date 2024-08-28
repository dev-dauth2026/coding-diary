<?php

namespace App\Helpers;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityHelper
{
    public static function log($activityType, $description = null, $subject = null)
    {
        Activity::create([
            'user_id' => Auth::id(),
            'activity_type' => $activityType,
            'description' => $description,
            'subject_type' => $subject ? $subject->title : null,
            'subject_id' => $subject ? $subject->id : null,
        ]);
    }
}
