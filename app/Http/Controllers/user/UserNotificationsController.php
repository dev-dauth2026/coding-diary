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
        $query = Notification::whereNot('user_id', $user->id);

        // Apply filters
        if ($request->filled('search')) {
            $query->where('data->message', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('is_read')) {
            $query->where('is_read', $request->is_read);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $notifications = $query->orderBy('created_at', 'desc')->paginate(10);

        // Show the latest notification detail by default
        $selectedNotification = null;
        if ($request->has('id')) {
            $selectedNotification = Notification::where('id', $request->id)
                ->where('user_id', $user->id)
                ->first();

            // Mark as read when viewed
            if ($selectedNotification && !$selectedNotification->is_read) {
                $selectedNotification->update(['is_read' => true]);
            }
        } else {
            $selectedNotification = $notifications->first();
            if ($selectedNotification && !$selectedNotification->is_read) {
                $selectedNotification->update(['is_read' => true]);
            }
        }

        return view('user_dashboard.notifications', compact('notifications', 'selectedNotification'));
    }

    public function markAsRead(Request $request, $id)
    {
        $user = Auth::user();
        $notification = Notification::where('id', $id)
            ->whereNot('user_id', $user->id)
            ->first();

        if ($notification && !$notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        return redirect()->route('account.notifications', ['id' => $id]);
    }
}
