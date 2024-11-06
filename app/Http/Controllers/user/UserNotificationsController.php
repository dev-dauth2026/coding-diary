<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Notification::where('notifiable_id', $user->id);
        $is_read = $request->filled('is_read','all');

        // Apply filters
        if ($request->filled('search')) {
            $query->where('data->content', 'like', '%' . $request->search . '%');
        }     

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $notifications = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('user_dashboard.notifications', compact('notifications'));
    }
}
