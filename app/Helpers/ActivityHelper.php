<?php

namespace App\Helpers;

use App\Models\Activity;
use App\Models\WatchedBlog;
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
            'subject_type' => is_object($subject) ? get_class($subject) : null,
            'subject_id' => is_object($subject) ? $subject->id : null,

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

    public static function trackWatchedBlog($post)
    {
        // watchedBlog for authenticated user
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the blog is already watched
            $watchedBlog = WatchedBlog::where('user_id', $user->id)
                                      ->where('blog_post_id', $post->id)
                                      ->first();

            if (!$watchedBlog) {
                // Record this post as watched for the first time
                WatchedBlog::create([
                    'user_id' => $user->id,
                    'blog_post_id' => $post->id,
                    'viewed_at' => now(), // Record the current time
                    'view_count' => 1,
                ]);
            } else {
                // Update the existing watched record
                $watchedBlog->update([
                    'viewed_at' => now(), // Update the last viewed time
                    'view_count' => $watchedBlog->view_count + 1, // Increment the view count
                ]);
            }
        }else{
            // watchedBlog for unauthenticated user
            $watchedBlog = WatchedBlog::whereNull('user_id')
            ->where('blog_post_id', $post->id)
            ->first(); 
            
            if (!$watchedBlog) {
                // Record this post as watched for the first time
                WatchedBlog::create([
                    'user_id' => null,
                    'blog_post_id' => $post->id,
                    'viewed_at' => now(), // Record the current time
                    'view_count' => 1,
                ]);
            } else {
                // Update the existing watched record
                $watchedBlog->update([
                    'viewed_at' => now(), // Update the last viewed time
                    'view_count' => $watchedBlog->view_count + 1, // Increment the view count
                ]);
            }

        }
    }
}
