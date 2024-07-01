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
    public function createBlog(){
        return view('admin.createBlog');
    }

    public function processCreateBlog(Request $request){
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
            return redirect()->route('admin.createBlog')->withErrors($validator)->withInput();
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

            return redirect()->route('admin.dashboard')->with('postCreated','The post has been successfully created!');
        }

       
    }

    public function editPost($id){
        $post = Post::findOrFail($id);
        return view('admin.editPost', compact('post'));
    }

    public function updatePost(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:3',
            'content' => 'required',
            'tags' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validator->fails()){
            return redirect()->route('admin.editPost', $id)->withInput()->withErrors($validator);
        }

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->tags = $request->tags;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagePath = $image->store('image/temp','public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('admin.dashboard')->with('postUpdated','The post has been successfully updated.');
    }
}
