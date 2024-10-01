<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Blog_Like;
use App\Models\WatchedBlog;
use Illuminate\Http\Request;
use App\Models\FavouriteBlog;
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

        $favourite = Auth::user()->favouriteBlogs->contains('blog_post_id',$post->id);

        return view('blog',compact('post','posts','totalBlogs','comments','favourite'));
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

        $favourite = Auth::check()?Auth::user()->favouriteBlogs->contains('id',$post->id):false;

        // Retrieve all posts except the one with the given ID
        $posts = Post::where('status','published')->where('id', '!=', $id)->get();
        $totalBlogs =$posts->count();


        if (!$post) {
            // Handle the case where the post is not found, e.g., show a 404 page
            abort(404, 'Post not found');
        }

        return view('blog', compact('post','posts','totalBlogs','comments','favourite'));
    }

    public function addFavourite($id){

        $post= Post::where('status','published')->findOrFail($id);

        $favourite_blog = new FavouriteBlog();
        $favourite_blog->user_id = Auth::id();
        $favourite_blog->blog_post_id = $post->id;

        $favourite_blog->save();

        // Log activity
        ActivityHelper::log('saved_favorite', 'liked a post', $favourite_blog->post);

        return redirect()->route('blog.detail',$id)->with('success', 'Blog has been added to  favourites.');

    }

    public function removeFavourite($postId)
{
    $user = Auth::user();
    $user->favouriteBlogs()->detach($postId);

    // Log activity
    $post = Post::findOrFail($postId);
    ActivityHelper::log('removed_favorite', 'removed a post from a favorite list', $post);

    return redirect()->back()->with('success', 'Blog has been removed from favourites.');
}



    
}
