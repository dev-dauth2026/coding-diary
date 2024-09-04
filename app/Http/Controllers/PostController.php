<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Blog_Like;
use App\Models\WatchedBlog;
use Illuminate\Http\Request;
use App\Helpers\ActivityHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function blog(){
        $user = Auth::user();
        $post = Post::where('status','published')->latest()->first();
        $posts = Post::where('status','published')->latest()->paginate(3);
        $totalBlogs = Post::where('status','published')->count();
        $comments = Comment::where('blog_post_id',$post->id)
                            ->whereNull('parent_id')
                            ->with('replies')
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);

        // Use helper function to track watched blogs
        ActivityHelper::trackWatchedBlog($post);

        return view('blog',compact('post','posts','totalBlogs','comments'));
    }
    public function allBlogs(){

        $featured_posts = Post::where('status','published')->where('featured',true)->latest()->limit(3)->get();
        $posts = Post::where('status','published')->latest()->paginate(3);
        $totalBlogs = Post::where('status','published')->count();
        $latestPost = Post::where('status','published')->latest()->first();

        return view('allBlogs',compact('posts','totalBlogs','latestPost','featured_posts'));
    }
    public function blogSearch(Request $request){

        $validator = Validator::make($request->all(),[
            'blogSearch' =>'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.blog.all')->withInput()->withErrors($validator);
        }
        
        $query = $request->input('blogSearch');

        $totalBlogs = Post::where('status','published')->count();
       
        if(!empty($query)){
            $totalSearchPosts = Post::where('status','published')->where('title', 'like', "%{$query}%")
                                     ->orWhere('status','published')->where('content', 'like', "%{$query}%");
            $posts =$totalSearchPosts->paginate(3);
        }else{
            $posts = Post::where('status','published')->latest()->paginate(3);
        }
       
        return view('allBlogs',compact('posts','query', 'totalBlogs'));
        
    }


    public function blogDetail($id){
        $post = Post::where('status','published')->findOrFail($id);
        $comments = Comment::where('blog_post_id',$post->id)
                    ->whereNull('parent_id')
                    ->with('replies')
                    ->with('likes')
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);

        // Retrieve all posts except the one with the given ID
        $posts = Post::where('status','published')->where('id', '!=', $id)->get();
        $totalBlogs =$posts->count();


        if (!$post) {
            // Handle the case where the post is not found, e.g., show a 404 page
            abort(404, 'Post not found');
        }

        return view('blog', compact('post','posts','totalBlogs','comments'));
    }


    
}
