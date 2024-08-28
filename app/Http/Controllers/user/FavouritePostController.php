<?php

namespace App\Http\Controllers\user;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Helpers\ActivityHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavouritePostController extends Controller
{
    public function dashboardFavouriteBlog(){
        $favourites = Auth::user()->favouriteBlogs()->get();

        return view('user_dashboard.favouriteBlogs',compact('favourites'));
    }
    public function addFavourite($id){

        $post= Post::findOrFail($id);

        if(Auth::user()){

            $user = Auth::user();
            $user->favouriteBlogs()->attach($id);
            // Log activity
            ActivityHelper::log('like', 'Liked a post', $post);
    
            return redirect()->back()->with('success', 'Blog has been added to  favourites.');
        }

        return redirect()->route('account.login')->with('error', 'You are not logged in. Please log in.');

    }

    public function removeFavourite($id){
        $post= Post::findOrFail($id);

        if(Auth::user()){

            $user = Auth::user();
            $user->favouriteBlogs()->detach($id);

            // Log activity
            ActivityHelper::log('unlike', 'Remove a post from a favorite list', $post);
    
            return redirect()->back()->with('success', 'Blog has been removed from  favourites.');
        }

        return redirect()->route('account.login')->with('error', 'You are not logged in. Please log in.');

    }

   
}
