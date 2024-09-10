<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminCommentsController extends Controller
{
    public function comments(Request $request){
        $search_comment = $request->input('search_comment');
        $post_title_id = $request->input('post_title');

        $query = Comment::with('replies')->with('blogPost')->orderBy('created_at','DESC');
        $posts = Post::orderBy('title', 'asc')->get();

        if($search_comment && $post_title_id){
            $query->where('content', 'like', '%' . $search_comment . '%')
                 ->whereHas('blogPost',function ($query) use ($post_title_id){
                $query->where('id',$post_title_id);
                 });
                    
        }
        
        if($search_comment ){
            $query->where('content', 'like', '%' . $search_comment . '%');
                    
        }

        if($post_title_id){
            $query->whereHas('blogPost',function ($query) use ($post_title_id){
                $query->where('id',$post_title_id);
            });
        }

        $comments= $query->paginate(10);
                            
        $totalComments = $comments->count();
        return view('admin.comments',compact('comments','totalComments','search_comment','posts','post_title_id'));
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

    public function reply(Request $request,$comment_id){
        

        $validator = Validator::make($request->all(),[
            'comment_reply' =>'required|min:3',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('reply_error','The comment should be at least 3 characters.');
        }

        //Find parent comment
        $parentComment = Comment::findOrFail($comment_id);

        $comment = new Comment();
        $comment->user_id = Auth::guard('admin')->user()->id;
        $comment->blog_post_id = $parentComment->blog_post_id;
        $comment->content = $request->comment_reply;
        $comment->parent_id = $comment_id;

        $comment->save();

        return redirect()->back()->with('success','You have replied to the comment successfully.');
    }
}
