<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Message;
use App\Notifications\MessageNotification;

class MessageObserver
{
    public function created(Message $message): void
    {
        $receiver = $message->receiver;
        $eventType = $message->parent_id ? 'reply_created' : 'message_created';

        // Determine the role of the receiver
        $receiverRole = $receiver->role_id == 1 ? 'admin' : 'user';

        $receiver->notify(new MessageNotification($message, $eventType,$receiverRole));
    }

    public function updated(Message $message): void
    {
        $receiver = $message->receiver;
        $eventType = $message->wasChanged('content') ? 'message_updated': null;

        // Determine the role of the receiver
        $receiverRole = $receiver->role_id == 1 ? 'admin' : 'user';

        if ($eventType) {
            $receiver->notify(new MessageNotification($message, $eventType,$receiverRole));
        }
    }

    public function deleted(Message $message): void
    {
        $receiver = $message->receiver;
        $eventType = 'message_deleted';

        // Determine the role of the receiver
        $receiverRole = $receiver->role_id == 1 ? 'admin' : 'user';


        $receiver->notify(new MessageNotification($message, $eventType,$receiverRole));
    }
}
