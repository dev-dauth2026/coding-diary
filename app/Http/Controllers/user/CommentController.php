<?php

namespace App\Http\Controllers\user;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // Import Carbon for date handling

class CommentController extends Controller
{
    public function show()
    {
        // Fetch paginated comments ordered by creation date in descending order
        $comments = Auth::user()->comments()->orderBy('created_at', 'DESC')->paginate(6);
        
        // Calculate the total number of comments
        $totalComment = Auth::user()->comments()->count();

        // Calculate the total number of comments for the current month
        $totalCommentsThisMonth = Auth::user()->comments()->whereMonth('created_at', Carbon::now()->month)
                                          ->whereYear('created_at', Carbon::now()->year)
                                          ->count();

        // Fetch the most liked comment for the authenticated user
        $mostLikedComment = Auth::user()->comments()
            ->withCount('likes')
            ->orderBy('likes_count', 'DESC')
            ->first();

        // Pass the data to the view
        return view('user_dashboard.comments', compact('comments', 'totalComment', 'totalCommentsThisMonth','mostLikedComment'));
    }
    // method ends 

    public function update(Request $request, Comment $comment){
        $validator = Validator::make($request->all(),[
            'update_content' => 'required|min:3'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator,'replyError')->withInput()->with('edit_reply_comment_id',$comment->id);
        }

        $comment->content = $request->update_content;

        $comment->save();

        return redirect()->back()->with('success','The comment has been successfully updated.');
    }
    // method ends 

    public function destroy(Comment $comment){
        $comment->delete();

        return redirect()->back()->with('success','The comment has been successfully deleted.');

    }
    // method ends 


}
