<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function blogs(){
        $allBlogs = Post::all();
        
        return view('admin.allBlogs',['allBlogs'=> $allBlogs] );

    }
    public function create(){
        $adminUsers = User::where('role_id','1')->get();
        $auth =Auth::guard('admin')->user();
        $statusOptions = Post::getStatusOptions();
        $categories = Category::all();

        return view('admin.createBlog', compact('auth','statusOptions', 'categories','adminUsers'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' =>'required|min:3',
            'content' =>'required',
            'slug' =>'required',
            'status'=>'required',
            'category'=>'required',
            'author' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            // Store temporary image path in session if an image was uploaded
            if ($request->hasFile('image')) {
                $tempImagePath = $request->file('image')->store('images/temp', 'public');
                Session::put('temp_image', $tempImagePath);
            }

            // Redirect back to the form with errors and old input
            return redirect()->route('admin.blog.create')->withErrors($validator)->withInput();
        }

        if($validator->passes()){
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->slug = $request->slug;
            $post->author_id = $request->author;
            $post->category_id = $request->category;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('images', 'public');
                $post->image = $imagePath;
                session()->forget('temp_image');
            }elseif (session('temp_image')) {
                $post->image = session('temp_image');
                session()->forget('temp_image');
            }

            $post->save();


            return redirect()->route('admin.blogs')->with('success','The post has been successfully created!');
        }


    }

    public function editPost(Post $post){
        $adminUsers = User::where('role_id','1')->get();
        $auth =Auth::guard('admin')->user();
        $statusOptions = Post::getStatusOptions();
        $categories = Category::all();
        return view('admin.editPost', compact('post','auth','statusOptions', 'categories','adminUsers'));
    }

    public function update(Request $request, Post $post){
        

        $validator = Validator::make($request->all(),[
            'title' =>'required|min:3',
            'content' =>'required',
            'slug' =>'required',
            'status'=>'required',
            'category'=>'required',
            'author' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            // Store temporary image path in session if an image was uploaded
            if ($request->hasFile('image')) {
                $tempImagePath = $request->file('image')->store('images/temp', 'public');
                Session::put('temp_image', $tempImagePath);
            }

            // Redirect back to the form with errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Log::info('Validation passed');

        if($validator->passes()){
            $post->title = $request->title;
            $post->content = $request->content;
            $post->author_id = $request->author;
            $post->category_id = $request->category;
            $post->slug = $request->slug;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('images', 'public');
                $post->image = $imagePath;
                session()->forget('temp_image');
            }elseif (session('temp_image')) {
                $post->image = session('temp_image');
                session()->forget('temp_image');
            }

            $post->save();

            Log::info('Post updated successfully');
            return redirect()->route('admin.blogs')->with('success','The post has been successfully created!');
        }
    }

    public function destroy(Post $post){
        $post->delete();

        return redirect()->back()->with('success','The post has been successfully deleted');
    }

  

   
}
