<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function blog(){
        $posts = Post::latest()->paginate(3);
        $totalBlogs = Post::count();
        $latestPost = Post::latest()->first();
        return view('blog',compact('posts','totalBlogs','latestPost'));
    }
    public function allBlogs(){
        $posts = Post::latest()->paginate(3);
        $totalBlogs = Post::count();
        $latestPost = Post::latest()->first();
        return view('allBlogs',compact('posts','totalBlogs','latestPost'));
    }
    public function blogSearch(Request $request){
        $query = $request->input('blogSearch');
        $validator = Validator::make($request->all(),[
            'blogSearch' =>'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.allBlogs')->withInput()->withErrors($validator);
        }

        $latestPost = Post::latest()->first();
       
        if(!empty($query)){
            $totalSearchPosts = Post::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%");
            $posts =$totalSearchPosts->paginate(3);
        }else{
            $posts = Post::latest()->paginate(3);
        }
       
        return view('allBlogs',compact('posts','latestPost','query', 'totalSearchPosts'));
        
    }
}
