<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalPosts = Post::count();
        $posts = Post::latest()->take(4)->get();
    // Retrieve users count with the specified role
        $totalUsers = User::where('role', 'customer')->count();
        $totalAdminUsers = User::where('role', 'admin')->count();
        return view('admin.dashboard',compact('totalPosts','totalUsers','totalAdminUsers','posts') );
    }

   
    
}
