<?php

namespace App\Observers;

use App\Models\Comment;
use App\Helpers\ActivityHelper;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        if ($comment->parent_id) {
            // This is a reply to another comment
            $parentComment = Comment::find($comment->parent_id);
            ActivityHelper::log(
                'reply_created',
                'User replied to the comment: "' . $parentComment->content . '"',
                $parentComment
            );
        } else {
            // This is a regular comment on a blog post
            ActivityHelper::log(
                'comment_created',
                'User created a comment on post: ' . $comment->blogPost->title,
                $comment->blogPost
            );
        }

        if ($comment->parent_id) {
            // This is a reply to another comment
            $parentComment = Comment::find($comment->parent_id);
            ActivityHelper::triggerNotification(
                'reply_created',
                'User replied to the comment: "' . $parentComment->content . '"',
                $parentComment
            );
        } else {
            // This is a regular comment on a blog post
            ActivityHelper::triggerNotification(
                'comment_created',
                'User created a comment on post: ' . $comment->blogPost->title,
                $comment->blogPost
            );
        }
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {

        if ($comment->parent_id) {
            // This is an update to a reply
            ActivityHelper::log(
                'reply_updated',
                'User updated their reply on the comment with ID: ' . $comment->parent_id,
                $comment->blogPost
            );
        } else {
            // This is an update to a regular comment
            ActivityHelper::log(
                'comment_updated',
                'User updated their comment on post: ' . $comment->blogPost->title,
                $comment->blogPost
            );
        }
        
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        ActivityHelper::log('delete','Comment ' . '"' . $comment->content . '"' . ' has been deleted ', $comment->blogPost);
        
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
