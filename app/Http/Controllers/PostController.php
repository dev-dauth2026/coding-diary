<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function blog(){
        $query = '';
        $totalSearchPosts = '';
        $posts = Post::latest()->paginate(2);
        $totalBlogs = Post::count();
        $latestPost = Post::latest()->first();
        return view('blog',compact('posts','totalBlogs','latestPost','query'));
    }

    public function blogSearch(Request $request){

        $latestPost = Post::latest()->first();
        $query = $request->input('blogSearch');
        $totalSearchPosts = Post::where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
        $posts =$totalSearchPosts->paginate(10);
        $validator = Validator::make($request->all(),[
            'blogSearch' =>'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.blog')->withInput()->withErrors($validator);
        }

        return view('blog',compact('posts','latestPost','query', 'totalSearchPosts'));


        
    }
}
