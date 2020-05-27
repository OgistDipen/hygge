<?php

use Illuminate\Database\Seeder;
use App\FriendRequest;

class FriendRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friend_requests')->delete();

        FriendRequest::create([
            'sender_user_id' => 1,
            'receiver_user_id' => 2,
            'request_status' => 'sent'
        ]);

        FriendRequest::create([
            'sender_user_id' => 1,
            'receiver_user_id' => 3,
            'request_status' => 'accepted'
        ]);

        FriendRequest::create([
            'sender_user_id' => 1,
            'receiver_user_id' => 4,
            'request_status' => 'denied'
        ]);

        FriendRequest::create([
            'sender_user_id' => 2,
            'receiver_user_id' => 5,
            'request_status' => 'sent'
        ]);

        FriendRequest::create([
            'sender_user_id' => 3,
            'receiver_user_id' => 2,
            'request_status' => 'sent'
        ]);

        FriendRequest::create([
            'sender_user_id' => 5,
            'receiver_user_id' => 3,
            'request_status' => 'sent'
        ]);

        FriendRequest::create([
            'sender_user_id' => 4,
            'receiver_user_id' => 5,
            'request_status' => 'sent'
        ]);
    }
}
