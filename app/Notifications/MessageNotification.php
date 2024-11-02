<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageNotification extends Notification implements ShouldQueue,ShouldBroadcastNow
{
    use Queueable;

    private $message;
    private $eventType;
    private $receiverRole;

    public function __construct($message,$eventType, $receiverRole)
    {
        $this->message = $message;
        $this->eventType = $eventType;
        $this->receiverRole = $receiverRole;
    }

    // Specify the channels for the notification
    public function via($notifiable)
    {
        // Only send notification to the receiver, not the sender
         return ['mail', 'database', 'broadcast'];
    }

    // Define the email representation of the notification
    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
        ->line('You have received a new message:')
        ->line($this->message->content)
       
        ->line('Thank you for using our application!');

        if ($this->message->sender->role_id==2) {
            $mailMessage ->action('View Message', route('admin.messages.show', $this->message->id));
        } else {
            $mailMessage ->action('View Message', route('account.messages.detail', $this->message->id));
        }

        return $mailMessage;
        
    }

    // Define the database representation of the notification
    public function toDatabase($notifiable)
    {
        return [
            'message_id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'content' => $this->message->content,
            'url' => url('/messages/'.$this->message->id),
        ];
    }

    // Define the broadcast representation of the notification
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message_id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'sender_name' => $this->message->sender->name,
            'content' => $this->message->content,
            'url' => url('/messages/'.$this->message->id),
        ]);
    }

     // Override the broadcastOn method to send to the right channel based on role
     public function broadcastOn()
     {
        \Log::info("Broadcasting on channel", [
            'role' => $this->receiverRole,
            'channel' => $this->receiverRole === 'admin'
                ? 'App.Models.Admin.' . $this->message->receiver_id
                : 'App.Models.User.' . $this->message->receiver_id
        ]);
    
        return new PrivateChannel(
            $this->receiverRole === 'admin'
                ? 'App.Models.Admin.' . $this->message->receiver_id
                : 'App.Models.User.' . $this->message->receiver_id
        );
     }
}