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
    public function blogs(Request $request){

        // Get the search query
        $search = $request->input('search');
        $status = $request->input('status', 'all');
        $category = $request->input('category', 'all');
        $order_by = $request->input('order_by', 'new');
        $pagination_by = $request->input('pagination_by', '10');


        //Fetching all categories from category table
        $categories = Category::orderBy('name','asc')->get();

        //Base query for fetching post
        $query = Post::query()->with('author');

        //
        $statusOptions = Post::getStatusOptions();

        //If search query is provided filter by post title
        if($search && $status !== 'all' && $category !=='all'){
            $query->where('title', 'like', '%' . $search . '%')
                ->where('status', $status)
                ->where('category_id',$category)
              ->orWhereHas('author', function($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              })
              ->where('status', $status)
              ->where('category_id',$category)
              ;
        }

        if($search && $status !== 'all' ){
            $query->where('title', 'like', '%' . $search . '%')
                ->where('status', $status)
              ->orWhereHas('author', function($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              })
              ->where('status', $status)
              ;
        }

        if($search && $category !=='all'){
            $query->where('title', 'like', '%' . $search . '%')
                ->where('category_id',$category)
              ->orWhereHas('author', function($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              })
              ->where('category_id',$category)
              ;
        }
        if($search ){
            $query->where('title', 'like', '%' . $search . '%')
              ->orWhereHas('author', function($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              })
              ;
        }

        if($status !== 'all'){
            $query->where('status', $status);
        }

        if($category !=='all'){
            $query->where('category_id',$category);
        }

      
        switch ($order_by) {
            case 'new':
                $query->orderBy('created_at','desc');
              break;
            case 'old':
                $query->orderBy('created_at','asc');
              break;
            case 'title_asc':
                $query->orderBy('title','asc');
              break;
            case 'title_desc':
                $query->orderBy('title','desc');
            break;
            default:
                $query->orderBy('created_at','desc');
          }




        $posts = $query->paginate($pagination_by);
        
        return view('admin.allBlogs',compact('posts','statusOptions','status','categories','category'));

    }
    // blog method ends 
    public function create(){
        $adminUsers = User::where('role_id','1')->get();
        $auth =Auth::guard('admin')->user();
        $statusOptions = Post::getStatusOptions();
        $categories = Category::all();

        return view('admin.createBlog', compact('auth','statusOptions', 'categories','adminUsers'));
    }
    //create method ends

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
    //store method ends

    public function editPost(Post $post){
        $adminUsers = User::where('role_id','1')->get();
        $auth =Auth::guard('admin')->user();
        $statusOptions = Post::getStatusOptions();
        $categories = Category::all();
        return view('admin.editPost', compact('post','auth','statusOptions', 'categories','adminUsers'));
    }
    // editPost method ends

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
    //update method ends

    public function updateStatus(Request $request,Post $post){
        $validator = Validator::make($request->all(),[
            'status' =>'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $post->status = $request->status;

        $post->save();

        return redirect()->back()->with('success', 'The status of the post has been successfully updated.');
    }
    //updateStatus method ends

    public function updateCategory(Request $request,Post $post){
        $validator = Validator::make($request->all(),[
            'category' =>'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $post->category_id = $request->category;

        $post->save();

        return redirect()->back()->with('success', 'The category of the post has been successfully updated.');
    }
    // updateCategory ends

    public function updateFeatured(Request $request,Post $post){
        $validator = Validator::make($request->all(),[
            'featured' =>'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $post->featured = $request->featured;

        $post->save();

        return redirect()->back()->with('success', 'The featured status of the post has been successfully updated.');
    }

    public function destroy(Post $post){
        $post->delete();

        return redirect()->back()->with('success','The post has been successfully deleted');
    }
    // destroy method ends

  

   
}
