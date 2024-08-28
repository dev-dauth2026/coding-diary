<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the message.
     */
    public function view(User $user, Message $message)
    {
        // Allow viewing if the user is the receiver or sender of the message
        return $user->id === $message->receiver_id || $user->id === $message->sender_id;
    }

    /**
     * Determine whether the user can reply to the message.
     */
    public function reply(User $user, Message $message)
    {
        // Only allow the receiver to reply to the message
        return $user->id === $message->receiver_id;
    }

    /**
     * Determine whether the user can delete the message.
     */
    public function delete(User $user, Message $message)
    {
        // Allow deletion if the user is the receiver or sender of the message
        return $user->id === $message->receiver_id || $user->id === $message->sender_id;
    }

    /**
     * Determine whether the user can mark the message as read.
     */
    public function markRead(User $user, Message $message)
    {
        // Only allow the receiver to mark the message as read
        return $user->id === $message->receiver_id;
    }
}
