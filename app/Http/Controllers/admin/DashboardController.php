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
    // Retrieve users count with the specified role
        $totalUsers = User::where('role', 'customer')->count();
        $totalAdminUsers = User::where('role', 'admin')->count();
        return view('admin.dashboard',['totalPosts'=> $totalPosts,'totalUsers' => $totalUsers,'totalAdminUsers'=>$totalAdminUsers] );
    }

    public function createBlog(){
        return view('admin.createBlog'); 
    }
    
}
