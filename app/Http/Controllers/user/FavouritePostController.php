<?php

namespace App\Http\Controllers\user;

use App\Models\FavouriteBlog;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Helpers\ActivityHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavouritePostController extends Controller
{
    public function dashboardFavouriteBlog(Request $request)
{
    $user = Auth::user();

    // Get query parameters for search, sort
    $search = $request->input('search');
    $sort = $request->input('sort');

    // Query user's favourite blogs with optional search and sort functionality
    $query = $user->favouriteBlogs()->where('status','published'); 
    // Apply search filtering
    if ($search) {
        $query->where('title', 'like', "%{$search}%");
    }

    // Apply sorting based on the requested criteria
    switch ($sort) {
        case 'title_asc':
            $query->orderBy('title', 'asc');
            break;
        case 'title_desc':
            $query->orderBy('title', 'desc');
            break;
        case 'oldest':
            $query->orderBy('created_at', 'asc');
            break;
        default: // Latest
            $query->orderBy('created_at', 'desc');
            break;
    }



    $favourites = $query->paginate(9);

     // Fetch recently updated blogs that are not already favorited by the user
     $recentlyWatched = Post::where('status','published')->whereIn('id', $user->watchedBlog()->pluck('blog_post_id'))
     ->orderBy('updated_at', 'desc')
     ->take(5)
     ->get();

    // Fetch recommended blogs based on favourite blogs of other users
    $recommendedBlogs = Post::whereNotIn('id', $user->watchedBlog()->pluck('blog_post_id'))
        ->inRandomOrder()  // Optionally randomize the order
        ->take(5)
        ->get();   

    return view('user_dashboard.favouriteBlogs', compact('favourites', 'recentlyWatched', 'recommendedBlogs'));
}
    
    }
