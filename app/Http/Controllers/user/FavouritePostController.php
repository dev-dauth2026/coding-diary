<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouritePostController extends Controller
{
    public function dashboardFavouriteBlog(){
        $favourites = Auth::user()->favouriteBlogs()->get();

        return view('user_dashboard.favouriteBlogs',compact('favourites'));
    }
    public function addFavourite($id){

        if(Auth::user()){

            $user = Auth::user();
            $user->favouriteBlogs()->attach($id);
    
            return redirect()->back()->with('success', 'Blog has been added to  favourites.');
        }

        return redirect()->route('account.login')->with('error', 'You are not logged in. Please log in.');

    }

    public function removeFavourite($id){

        if(Auth::user()){

            $user = Auth::user();
            $user->favouriteBlogs()->detach($id);
    
            return redirect()->back()->with('success', 'Blog has been removed from  favourites.');
        }

        return redirect()->route('account.login')->with('error', 'You are not logged in. Please log in.');

    }

   
}
