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
         return redirect()->back()->with('success', 'Comment updated successfully.');

    }
    public function destroy(Comment $comment){
         // Ensure the authenticated user is the owner of the comment
         if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Delete the comment
        $comment->delete();

        // Redirect back to the blog post with a success message
        return redirect()->back()->with('success', 'Comment deleted successfully.');


    }

    public function commentReply(Request $request, $commentId){
        $validator  = Validator::make($request->all(),[
            'comment_reply' => 'required | min:3',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator,'replyError')->withInput()->with('reply_comment_id',$commentId);
        }

        $comment = new Comment();

        $parent_comment = Comment::findOrFail($commentId);

        $comment->user_id = Auth::user()->id;
        $comment->blog_post_id = $parent_comment->blog_post_id;
        $comment->content = $request->comment_reply;
        $comment->parent_id = $commentId;

        $comment->save();

        return redirect()->back()->with('success','You have replied to the comment successfully.');

    }

    public function updateCommentReply(Request $request, $commentId){
        $validator  = Validator::make($request->all(),[
            'replies_content' => 'required | min:3',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator,'replyError')->withInput()->with('edit_reply_comment_id',$commentId);
        }

        $comment = Comment::findOrFail($commentId);

        $comment->content = $request->replies_content;

        $comment->save();

        return redirect()->back()->with('success','You have edited the reply to the comment successfully.');
    }

   
}
