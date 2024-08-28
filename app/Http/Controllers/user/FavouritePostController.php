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

        if(Auth::user()){

            $user = Auth::user();
            $user->favouriteBlogs()->attach($id);
            // Log activity
            ActivityHelper::log('saved_favorite', 'liked a post', $post);
    
            return redirect()->back()->with('success', 'Blog has been added to  favourites.');
        }

        return redirect()->route('account.login')->with('error', 'You are not logged in. Please log in.');

    }

    public function removeFavourite(FavouriteBlog $favouriteBlog){

            $favouriteBlog->delete();
            // Log activity
            ActivityHelper::log('removed_favorite', 'removed a post from a favorite list', $favouriteBlog->post);
    
            return redirect()->back()->with('success', 'Blog has been removed from  favourites.');
        }
    }
