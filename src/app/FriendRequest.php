<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{

    protected $table = 'friend_requests';

    protected $fillable = [
        'sender_user_id',
        'receiver_user_id',
        'request_status',
    ];
}
