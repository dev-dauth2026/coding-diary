<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WatchedBlog;
use Illuminate\Support\Facades\Auth;

class WatchedBlogController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $watchedBlogs = WatchedBlog::where('user_id', $user->id)
                                    ->orderBy('viewed_at', 'desc')
                                    ->paginate(10);

        return view('user_dashboard.watchedBlogs', compact('watchedBlogs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($postId)
    {
        $user = Auth::user();

        $watchedBlog = WatchedBlog::firstOrCreate(
            ['user_id' => $user->id, 'blog_post_id' => $postId],
            ['viewed_at' => now(), 'view_count' => 1]
        );

        // Increment view count if already watched
        if (!$watchedBlog->wasRecentlyCreated) {
            $watchedBlog->increment('view_count');
            $watchedBlog->touch(); // Update the timestamps
        }

        return redirect()->route('blog.detail', $postId);
    }

    /**
     * Display the specified resource.
     */
    public function show(WatchedBlog $watchedBlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WatchedBlog $watchedBlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WatchedBlog $watchedBlog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WatchedBlog $watchedBlog)
    {
        //
    }
}
