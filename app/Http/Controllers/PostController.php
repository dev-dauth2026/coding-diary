<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function blog(){
        $posts = Post::orderBy('created_at','DESC')->get();
        $latestPost = Post::latest()->first();
        return view('blog',['allBlogs'=>$posts,'latestPost'=> $latestPost]);
    }
}
