<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
