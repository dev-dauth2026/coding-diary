<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCategoriesController extends Controller
{
    public function blogCategory(){
        $categories = Category::orderBy('created_at','desc')->get();
        return view('admin.blog_category', compact('categories'));
    }

    public function createCategoryFormShow(){
        return view('admin.add_category');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
            'description' => 'required|min:3'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $category = new Category();

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admin.blog.category')->with('success', 'Category has been successsfully created');

    }

    public function editCategory(Category $category){
        return view('admin.edit_category', compact('category'));

    }

    public function updateCategory(Request $request,Category $category){
        $validator = Validator::make($request->all(),[
            'name' =>'required|min:3',
            'slug' => 'required|min:3',
            'description' => 'required|min:3',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admin.blog.category')->with('success','Category has been successfully updated.');

    }

    public function destroyCategory(Request $request,Category $category){
        $category->delete();

        return redirect()->back()->with('success','The category has been successfully deleted.');
    }
}
