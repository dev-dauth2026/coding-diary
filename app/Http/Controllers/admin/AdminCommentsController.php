<?php

namespace App\Http\Controllers\admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminCommentsController extends Controller
{
    public function comments(){
        $comments = Comment::orderBy('created_at','DESC')->get();
        $totalComments = $comments->count();
        return view('admin.comments',compact('comments','totalComments'));
    }

    public function editComments(Comment $comment){
        return view('admin.edit_comments',compact('comment'));
    }

    public function updateComments(Request $request, Comment $comment){
        $validator = Validator::make($request->all(),[
            'content'=> 'required|min:3',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $comment->content = $request->content;

        $comment->save();

        return redirect()->route('admin.comments')->with('success', 'Comments has been successfully updated.');
        
    }

    public function destroy(Comment $comment){
        $comment->delete();

        return redirect()->back()->with('success','The comment has been successfully deleted.');
    }
}
