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
    $query = $user->favouriteBlogs()->with('post');

    if ($search) {
        $query->whereHas('post', function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%");
        });
    }

    switch ($sort) {
        case 'oldest':
            $query->orderBy('created_at', 'asc');
            break;
        case 'title_asc':
            $query->orderBy('title', 'asc');
            break;
        case 'title_desc':
            $query->orderBy('title', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    $favourites = $query->paginate(9);

     // Fetch recently updated blogs that are not already favorited by the user
     $recentlyWatched = Post::whereIn('id', $user->watchedBlog()->pluck('blog_post_id'))
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
    public function addFavourite($id){

        $post= Post::findOrFail($id);

        $favourite_blog = new FavouriteBlog();
        $favourite_blog->user_id = Auth::id();
        $favourite_blog->blog_post_id = $post->id;

        $favourite_blog->save();

        // Log activity
        ActivityHelper::log('saved_favorite', 'liked a post', $favourite_blog->post);

        return redirect()->back()->with('success', 'Blog has been added to  favourites.');

    }

    public function removeFavourite(FavouriteBlog $favouriteBlog){

            $favouriteBlog->delete();
            // Log activity
            ActivityHelper::log('removed_favorite', 'removed a post from a favorite list', $favouriteBlog->post);
    
            return redirect()->back()->with('success', 'Blog has been removed from  favourites.');
        }
    }
