<?php

namespace App\Http\Controllers\admin;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminMessagesController extends Controller
{
    // List messages with search and filters
    public function index(Request $request)
    {
        $message_search = $request->input('message_search');
        $status = $request->input('status');
        $message_status = $request->input('message_status', 'received');
        $page = $request->input('page', 1);
        $recipients = User::whereNot('id',Auth::guard('admin')->user()->id)->get();
        // Initialize the query variable
        $query = Message::query(); // Start with the Message model query
    
        // // Handle received and sent messages separately
        if ($message_status == 'received') {
            $query = Auth::guard('admin')->user()->receivedMessages(); // Only received messages
        } elseif ($message_status == 'sent') {
            $query = Auth::guard('admin')->user()->sentMessages(); // Only sent messages
        }
    
        // Search functionality for subject, content, and sender's name
        if ($message_search) {
            $query->where(function ($q) use ($message_search) {
                $q->where('subject', 'like', '%' . $message_search . '%')
                    ->orWhere('content', 'like', '%' . $message_search . '%')
                    ->orWhereHas('sender', function ($q) use ($message_search) {
                        $q->where('name', 'like', '%' . $message_search . '%');
                    });
            });
        }
    
        // Filter by read/unread status
        if ($status !== null) {
            if ($status == '1') {
                $query->where('is_read', true); // Only read messages
            } elseif ($status == '0') {
                $query->where('is_read', false); // Only unread messages
            }
        }
    
        // Paginate results
        $messages = $query->latest()->paginate(5)->appends([
            'message_status' => $message_status,
            'message_search' => $message_search,
            'status' => $status
        ]);;

    
        // Select the first message for display
        $message = $query->first();
    
        // Pass data to view
        return view('admin.messages', compact('messages', 'message', 'message_status','page','message_search','recipients'));
    }
    
    // index method ends

    // Show a single message
    public function show(Message $message, Request $request)
    {
        $message_search = $request->input('message_search');
        $status = $request->input('status');
        $message_status = $request->input('message_status');
        $page = $request->input('page', 1);
        $recipients = User::whereNot('id',Auth::id());
         // Fetch all messages for the authenticated user
         $query = Message::query();

         // // Handle received and sent messages separately
        if ($message_status == 'received') {
            $query = Auth::guard('admin')->user()->receivedMessages(); // Only received messages
        } elseif ($message_status == 'sent') {
            $query = Auth::guard('admin')->user()->sentMessages(); // Only sent messages
        }

        // Search functionality for subject, content, and sender's name
        if ($message_search) {
            $query->where(function ($q) use ($message_search) {
                $q->where('subject', 'like', '%' . $message_search . '%')
                    ->orWhere('content', 'like', '%' . $message_search . '%')
                    ->orWhereHas('sender', function ($q) use ($message_search) {
                        $q->where('name', 'like', '%' . $message_search . '%');
                    });
            });
        }
    
        // Filter by read/unread status
        if ($status !== null) {
            if ($status == '1') {
                $query->where('is_read', true); // Only read messages
            } elseif ($status == '0') {
                $query->where('is_read', false); // Only unread messages
            }
        }

        // Mark message as read if not already
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        // Paginate results
        $messages = $query->latest()->paginate(5)->appends([
            'message_status' => $message_status,
            'message_search' => $message_search,
            'status' => $status
        ]);

        return view('admin.messages', compact('messages','message','message_status','page','message_search','recipients'));
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

        $message->sender_id = Auth::guard('admin')->user()->id;
        $message->receiver_id = $request->recipient_id;
        $message->subject = $request->subject;
        $message->content = $request->message_content;
        $message->is_read = false;

        $message->save();

        return redirect()->back()->with('success','You have sent message successfully.');
    }

    public function reply(Request $request,$messageId){        
        $validator= Validator::make($request->all(),[
            'reply_content'=>'required|min:3',      
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator)->with('reply-error-id',$messageId);
        }

        $message = new Message();
        $parent_message = Message::findOrFail($messageId);

        $message->sender_id = Auth::guard('admin')->user()->id;
        $message->receiver_id = $parent_message->sender_id;
        $message->parent_id = $messageId;
        $message->subject = "Re:" . $parent_message->subject;
        $message->content = $request->reply_content;
        $message->is_read = false;

        $message->save();

        return redirect()->back()->with('success','You have replied to the message successfully.');
    }

    // Delete a message
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages')->with('success', 'Message deleted successfully.');
    }
}
