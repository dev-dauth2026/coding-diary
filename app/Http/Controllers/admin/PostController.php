<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
        $auth =Auth::guard('admin')->check();
        return view('admin.createBlog', compact('auth'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' =>'required|min:3',
            'content' =>'required',
            'tags' =>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $post->tags = $request->tags;

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
        return view('admin.editPost', compact('post'));
    }

    public function update(Request $request, Post $post){
        Log::info('Session ID: ' . session()->getId());
        Log::info('Admin ID in session: ' . session('admin_id'));
        Log::info('CSRF Token: ' . $request->input('_token'));

        $validator = Validator::make($request->all(),[
            'title' =>'required|min:3',
            'content' =>'required',
            'tags' =>'required',
            'author'=> 'required',
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
            $post->author = $request->author;
            $post->tags = $request->tags;

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
