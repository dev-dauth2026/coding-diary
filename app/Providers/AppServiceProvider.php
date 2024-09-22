<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.user-dashboard-navbar', function ($view) {
            // Fetch unread messages for the authenticated user
            $unreadMessageCount = Auth::check() ? Auth::user()->unreadMesssagesCount(): 0;
            // Pass the count to the view
            $view->with('unreadMessageCount', $unreadMessageCount);
        });
    }
}
