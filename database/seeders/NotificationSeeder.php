<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            [
                'user_id' => 1,
                'type' => 'comment',
                'data' => json_encode(['message' => 'You have a new comment on your post.']),
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'type' => 'like',
                'data' => json_encode(['message' => 'Your post was liked by someone.']),
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
