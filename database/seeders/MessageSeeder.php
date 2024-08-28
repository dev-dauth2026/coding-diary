<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Str;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::take(2)->get();

        if ($users->count() < 2) {
            $this->command->info('Please create at least two users in the users table.');
            return;
        }

        $sender = $users[0];
        $receiver = $users[1];

        // Creating 10 sample messages
        for ($i = 1; $i <= 10; $i++) {
            Message::create([
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'subject' => 'Sample Message Subject ' . $i,
                'content' => 'This is a sample message content for message number ' . $i . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'is_read' => $i % 2 == 0, // Every second message is marked as read
            ]);
        }

        // Creating replies for each message
        $messages = Message::all();

        foreach ($messages as $message) {
            Message::create([
                'sender_id' => $receiver->id,
                'receiver_id' => $sender->id,
                'subject' => 'Re: ' . $message->subject,
                'content' => 'This is a reply to message number ' . $message->id . '. Vivamus suscipit tortor eget felis porttitor volutpat.',
                'is_read' => false,
            ]);
        }

        $this->command->info('Messages table seeded successfully!');
    }
    
}
