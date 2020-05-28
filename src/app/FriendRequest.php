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


    public function senderUser()
    {
        return $this->belongsToMany('App\FriendRequest', 'sender_user_id');
    }
    public function receiverUser()
    {
        return $this->belongsToMany('App\FriendRequest', 'receiver_user_id');
    }
}
