<?php

    namespace App\Http\Controllers\User;

    use App\Http\Controllers\Controller;
    use App\Models\Activity;
    use App\Models\Blog_Like;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Message;
    use App\Models\Comment;
    use App\Models\Favorite;
    use App\Models\Post; // Assuming there's a Post model for user posts

    class DashboardController extends Controller
    {
        public function dashboard()
        {
            $user = Auth::user();

            // Fetch statistics
            $totalFavorites = $user->favouriteBlogs->count();
            $newMessages = Message::where('receiver_id', $user->id)->where('is_read', false)->count();
            $totalMessages = Message::where('receiver_id', $user->id)->count();
            $totalComments = Comment::where('user_id', $user->id)->count();
            $newReplies = Comment::whereIn('parent_id', function ($query) use ($user) {
                                $query->select('id')
                                    ->from('comments')
                                    ->where('user_id', $user->id);
                            })
                            ->where('user_id', '!=', $user->id)
                            ->where('is_read', false)
                            ->count();

            // Fetch recommended posts for the user (this can be based on user interests, categories, etc.)
            $recommendedPosts = Post::where('status', 'published')
            ->whereNotIn('id', $user->favouriteBlogs->pluck('post_id')) 
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

            $activities = Activity::where('user_id',$user->id)->orderBy('created_at','desc')->take(4)->get();

            return view('user_dashboard.dashboard', compact('totalFavorites', 'newMessages', 'totalMessages', 'totalComments', 'newReplies','recommendedPosts','activities'));
        }

        public function account()
        {
            return view('user_dashboard.account');
        }

        public function favourites()
        {
            return view('user_dashboard.favourites'); // Create a favourites.blade.php for this
        }

        public function comments()
        {
            return view('user_dashboard.comments'); // Create a comments.blade.php for this
        }

        public function notifications()
        {
            return view('user_dashboard.notifications'); // Create a notifications.blade.php for this
        }

        public function messages()
        {
            return view('user_dashboard.messages'); // Create a messages.blade.php for this
        }
    }
