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
    public function show(Request $request)
    {
        $comment_search =$request->input('comment_search');
        $date_filter = $request->input('date_filter');

        $recent_comments_replies =Comment::whereHas('parent', function ($query) {
                                    $query->where('user_id', Auth::id()); // Parent comment belongs to the authenticated user
                                })
                                ->where('user_id', '!=', Auth::id()) // The reply is from another user
                                ->with('parent', 'blogPost', 'user') // Load related data
                                ->orderBy('created_at', 'DESC')
                                ->paginate(5); // Paginate results

    

        $query = Auth::user()->comments()
                    ->with('replies')
                    ->orderBy('created_at', 'DESC');


        if($comment_search){
            $query->where('content','like', '%' . $comment_search . '%')
                   ->orwhereHas('blogPost', function($postQuery) use($comment_search){
                    $postQuery->where('title', 'like', '%' . $comment_search .'%');
                   });
        }

          // Filter by date
        if ($date_filter) {
            switch ($date_filter) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at', Carbon::yesterday());
                    break;
                case '7':
                    $query->whereDate('created_at', '>=', Carbon::now()->subDays(7));
                    break;
                case '30':
                    $query->whereDate('created_at', '>=', Carbon::now()->subDays(30));
                    break;
                case '365':
                    $query->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }


        // Fetch paginated comments ordered by creation date in descending order
        $comments =  $query->paginate(6);
        
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

         // Fetch top 3 liked comments
        $topLikedComments = Comment::with('blogPost') 
                            ->withCount('likes')
                            ->orderBy('likes_count', 'desc')
                            ->take(3)
                            ->get();

        // Pass the data to the view
        return view('user_dashboard.comments', compact('recent_comments_replies','comments', 'totalComment', 'totalCommentsThisMonth','mostLikedComment','topLikedComments','comment_search'));
    }
    // method ends 

        public function store(Request $request, $commentId){
        $validator = Validator::make($request->all(),[
            'comment_reply' =>'required| min:3'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('reply_error_id',$commentId);
        }

        $comment = new Comment();

        $parent_comment = Comment::findOrFail($commentId);

        if(!$parent_comment){
            return redirect()->back()->with('error', 'The comment not found.');
        }


        $comment->user_id = Auth::user()->id;
        $comment->blog_post_id = $parent_comment->blog_post_id;
        $comment->content = $request->comment_reply;
        $comment->parent_id = $parent_comment->id;

        $comment->save();

        return redirect()->back()->with('success','Reply to the comment has been created successfully.');


    }

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

    public function search(){

    }


}
