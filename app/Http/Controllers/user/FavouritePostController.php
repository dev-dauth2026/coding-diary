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
    public function dashboardFavouriteBlog(){

        $user = Auth::user();
        $favourites = $user->favouriteBlogs;

        return view('user_dashboard.favouriteBlogs',compact('favourites'));
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
