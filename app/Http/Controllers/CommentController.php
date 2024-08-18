<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, $blogPostId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->blog_post_id = $blogPostId;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('blog.detail', $blogPostId)->with('success', 'Comment added successfully.');
    }

    public function commentEdit($id){
        return 'comment edit';
    }

    public function commentUpdate(Request $request, Comment $comment){
         // Ensure the authenticated user is the owner of the comment
         if (Auth::id() !== $comment->user_id) {
            return redirect()->route('account.blog', $comment->blog_post_id)->with('error', 'Unauthorized access.');
        }

         // Validate the request data
        $validator = Validator::make($request->all(),[
            'updateContent' => 'required|string|max:1000',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
     


        // Update the comment content
        $comment->content = $request->updateContent;
        $comment->save();

         // Redirect back to the blog post with a success message
         return redirect()->route('account.blog', $comment->blog_post_id)->with('success', 'Comment updated successfully.');

    }
    public function destroy(Comment $comment){
         // Ensure the authenticated user is the owner of the comment
         if (Auth::id() !== $comment->user_id) {
            return redirect()->route('blog.show', $comment->blog_post_id)->with('error', 'Unauthorized access.');
        }

        // Delete the comment
        $comment->delete();

        // Redirect back to the blog post with a success message
        return redirect()->route('account.blog', $comment->blog_post_id)->with('success', 'Comment deleted successfully.');


    }

   
}
