<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserMessageController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all messages for the authenticated user
        $message_status = $request->input('message_status', 'received');
        $message_search = $request->input('message_search');
        $page = $request->input('page', 1);
        $recipients = User::whereNot('id',Auth::user()->id)->get();
        $messagesQuery = Message::query();

        if ($message_status == 'received') {
            $messagesQuery = Auth::user()->receivedMessages(); // Only received messages
        } elseif ($message_status == 'sent') {
            $messagesQuery = Auth::user()->sentMessages(); // Only sent messages
        }

        // Search functionality
        if ($message_search) {
            $messagesQuery->where(function ($query) use ($request) {
                $query->where('subject', 'like', '%' . $request->search . '%')
                      ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Filter functionality
        if ($message_status) {
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
        $messages = $messagesQuery->latest()->paginate(8);
        $message = $messagesQuery->first();

        return view('user_dashboard.messages', compact('message','messages','message_search','message_status','recipients'));
    }

    public function show(Message $message, Request $request)
    {
          // Fetch all messages for the authenticated user
        $message_search = $request->input('message_search');
        $message_status = $request->input('message_status', 'received');
        $page = $request->input('page', 1);
        $recipients = User::whereNot('id',Auth::user()->id)->get();
        $messagesQuery = Message::query();

        if ($message_status == 'received') {
            $messagesQuery = Auth::user()->receivedMessages(); // Only received messages
        } elseif ($message_status == 'sent') {
            $messagesQuery = Auth::user()->sentMessages(); // Only sent messages
        }

        // Ensure the message belongs to the authenticated user
        Gate::authorize('view', $message);

        // Mark message as read if not already
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        // Paginate results
        $messages = $messagesQuery->paginate(8);

        return view('user_dashboard.messages', compact('message','messages','message_status','message_search','recipients'));
    }

    public function store(Request $request){        
        $validator= Validator::make($request->all(),[
            'recipient_id'=>'required',
            'subject'=>'required|min:3',
            'message_content'=>'required|min:3',      
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator)->with('compose-error',true);
        }

        $message = new Message();

        $message->sender_id = Auth::user()->id;
        $message->receiver_id = $request->recipient_id;
        $message->subject = $request->subject;
        $message->content = $request->message_content;
        $message->is_read = false;

        $message->save();

        return redirect()->back()->with('success','You have sent message successfully.');
    }

    public function reply(Request $request, Message $message)
    {
        Gate::authorize('reply', $message);

        $validator= Validator::make($request->all(),[
            'reply_content' => 'required|string|max:1000',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator)->with('reply-error-id',$message->id);
        }

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
