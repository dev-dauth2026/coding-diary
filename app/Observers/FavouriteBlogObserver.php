<?php

namespace App\Observers;

use App\Models\FavouriteBlog;
use App\Helpers\ActivityHelper;

class FavouriteBlogObserver
{
    /**
     * Handle the FavouriteBlog "created" event.
     */
    public function created(FavouriteBlog $favouriteBlog): void
    {
       
        // Log activity
        ActivityHelper::log('saved_favorite', 'liked a post ' . $favouriteBlog->post->title, $favouriteBlog);
    }

    /**
     * Handle the FavouriteBlog "updated" event.
     */
    public function updated(FavouriteBlog $favouriteBlog): void
    {
        //
    }

    /**
     * Handle the FavouriteBlog "deleted" event.
     */
    public function deleted(FavouriteBlog $favouriteBlog): void
    {
       
    }

    /**
     * Handle the FavouriteBlog "restored" event.
     */
    public function restored(FavouriteBlog $favouriteBlog): void
    {
        //
    }

    /**
     * Handle the FavouriteBlog "force deleted" event.
     */
    public function forceDeleted(FavouriteBlog $favouriteBlog): void
    {
        //
    }
}
