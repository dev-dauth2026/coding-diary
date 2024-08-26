<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Blog_Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, $blogPostId)  {
        $comment = new Comment();
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->user_id = Auth::id();
        $comment->blog_post_id = $blogPostId;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('blog.detail', $blogPostId)->with('success', 'Comment added successfully.');
    }
    // store method ends 


    public function commentEdit($id){
        return 'comment edit';
    }


    public function commentUpdate(Request $request, Comment $comment){
         // Ensure the authenticated user is the owner of the comment
         Gate::authorize('update',$comment);
        //  if (Auth::id() !== $comment->user_id) {
        //     return redirect()->route('account.blog', $comment->blog_post_id)->with('error', 'Unauthorized access.');
        // }

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

    // commentUpdate method ends 


    public function destroy(Comment $comment){
         // Ensure the authenticated user is the owner of the comment
         Gate::authorize('delete',$comment);

        // Delete the comment
        $comment->delete();

        // Redirect back to the blog post with a success message
        return redirect()->back()->with('success', 'Comment deleted successfully.');

    }
    // destroy method ends 


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
    // commentReply method ends 


    public function updateCommentReply(Request $request,Comment $comment){
        Gate::authorize('updateReply',$comment);
        $validator  = Validator::make($request->all(),[
            'replies_content' => 'required | min:3',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator,'replyError')->withInput()->with('edit_reply_comment_id',$comment->id);
        }

        $comment->content = $request->replies_content;

        $comment->save();

        return redirect()->back()->with('success','The comment has been successfully updated.');
    }
    // updateCommentReply method ends 


    public function likeComment($commentId){

        $blog_like = new Blog_Like();

        $comment = Comment::findOrFail($commentId);

        $user_id = Auth::id();

        $blog_like->user_id = $user_id;
        $blog_like->blog_post_id = $comment->blog_post_id;
        $blog_like->comment_id = $commentId;

        $blog_like->save();

        return redirect()->back()->with('liked_comment',$commentId);
    }
    // likeComment method ends 

    public function unlikeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $userId = Auth::id();

        // Check if the user has liked the comment
        $existingLike = $comment->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            // Delete the like
            $existingLike->delete();
        }

        return redirect()->back()->with('success', 'You unliked the comment successfully.');
    }

    // unlikeComment method ends 

   
}
