<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouritePostController extends Controller
{
    public function addFavourite($id){

        if(Auth::user()){

            $user = Auth::user();
            $user->favouriteBlogs()->attach($id);
    
            return redirect()->back()->with('success', 'Blog has been added to  favourites.');
        }

        return redirect()->route('account.login')->with('error', 'You are not logged in. Please log in.');

    }
}
