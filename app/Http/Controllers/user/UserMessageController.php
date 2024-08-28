<?php

namespace App\Http\Controllers\User;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserMessageController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all messages for the authenticated user
        $messagesQuery = Message::where('receiver_id', Auth::id())->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->filled('search')) {
            $messagesQuery->where(function ($query) use ($request) {
                $query->where('subject', 'like', '%' . $request->search . '%')
                      ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Filter functionality
        if ($request->filled('status')) {
            if ($request->status == 'unread') {
                $messagesQuery->where('is_read', false);
            } elseif ($request->status == 'read') {
                $messagesQuery->where('is_read', true);
            }
        }

        if ($request->filled('date')) {
            if ($request->date == 'last_7_days') {
                $messagesQuery->where('created_at', '>=', now()->subDays(7));
            } elseif ($request->date == 'last_30_days') {
                $messagesQuery->where('created_at', '>=', now()->subDays(30));
            } elseif ($request->date == 'this_year') {
                $messagesQuery->whereYear('created_at', now()->year);
            }
        }

        // Paginate results
        $messages = $messagesQuery->paginate(8);
        $message = $messagesQuery->first();

        return view('user_dashboard.messages', compact('message','messages'));
    }

    public function show(Message $message)
    {
         // Fetch all messages for the authenticated user
         $messagesQuery = Message::where('receiver_id', Auth::id())->orderBy('created_at', 'desc');

        // Ensure the message belongs to the authenticated user
        Gate::authorize('view', $message);

        // Mark message as read if not already
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        // Paginate results
        $messages = $messagesQuery->paginate(8);

        return view('user_dashboard.messages', compact('message','messages'));
    }

    public function reply(Request $request, Message $message)
    {
        Gate::authorize('reply', $message);

        $request->validate([
            'reply_content' => 'required|string|max:1000',
        ]);

        $message_reply = new Message();
        $message_reply->sender_id = Auth::id();
        $message_reply->receiver_id = $message->sender_id;
        $message_reply->subject = 'Re: ' . $message->subject;
        $message_reply->content = $request->reply_content;
        $message_reply->is_read = false;

        $message_reply->save();

        return redirect()->route('account.messages.show', $message->id)->with('success', 'Reply sent successfully!');
    }

    public function destroy(Message $message)
    {
        Gate::authorize('delete', $message);

        $message->delete();

        return redirect()->route('account.messages.index')->with('success', 'Message deleted successfully!');
    }

    public function markRead(Message $message)
    {
       Gate::authorize('markRead', $message);

        $message->update(['is_read' => true]);

        return redirect()->route('account.messages.index')->with('success', 'Message marked as read.');
    }
}
