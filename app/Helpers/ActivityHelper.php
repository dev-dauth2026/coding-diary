<?php

namespace App\Helpers;

use App\Models\Activity;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ActivityHelper
{
    /**
 * Log user activities in the database.
 *
 * @param  string  $activityType
 * @param  string|null  $description
 * @param  mixed|null  $subject
 * @return void
 */
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

      /**
     * Trigger a notification for user actions.
     *
     * @param  int  $userId
     * @param  string  $type
     * @param  string  $message
     * @param  mixed|null  $subject
     * @return void
     */
    public static function triggerNotification($userId, $type, $message, $subject = null)
    {
        Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'data' => ['message' => $message],
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id' => $subject ? $subject->id : null,
            'is_read' => false,
        ]);
    }
}
