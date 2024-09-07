<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalPosts = Post::count();
        $posts = Post::where('status','published')->latest()->take(4)->get();
    // Retrieve users count with the specified role
        $totalUsers = User::whereHas('role', function($query){
            $query->where('name','customer');
        })->count();
        $totalAdminUsers = User::whereHas('role', function($query){
            $query->where('name','admin');
        })->count();
         
    
       
        return view('admin.dashboard',compact('totalPosts','totalUsers','totalAdminUsers','posts') );
    }

   
    
}
