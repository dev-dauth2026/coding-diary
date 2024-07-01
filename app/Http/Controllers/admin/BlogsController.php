<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogsController extends Controller
{
    public function blogs(){
        $allBlogs = Post::all();
        
        return view('admin.allBlogs',['allBlogs'=> $allBlogs] );

    }
}
