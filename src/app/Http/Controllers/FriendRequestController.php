<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class FriendRequestController extends Controller
{

    public function sendRequest(Request $request)
    {
        $user = Auth::user();

        //Check if there is logged user
        if ($user) {

            $validator = Validator::make($request->all(), [
                'receiver_user_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $receiver_id = $request->input('receiver_user_id');

            //Check if request already exists
            $check = \App\FriendRequest::where('sender_user_id', $user->id)->where('receiver_user_id', $receiver_id)->first();

            if ($check) {
                return response()->json(['Message' => 'Request has already been sent.'], 403);
            }


            //If friend request dont exist, create it.
            $send_request = \App\FriendRequest::create([
                'sender_user_id' => $user->id,
                'receiver_user_id' => $request->input('receiver_user_id'),
                'request_status' => 'sent'
            ]);


            return response()->json(['message' => 'Friend request successfully sent.', 'data' => $send_request], 200);
        }
        //if not logged individual is trying to send friend request, send error.
        return response()->json(['message' => 'Action Forbidden.'], 403);
    }

    public function denyRequest($id)
    {
        //get friend_request by id
        $check_pending_request = \App\FriendRequest::where('request_status', 'sent')->find($id);

        //check if its the right user and if friend request exists
        if (Auth::user()->id === $check_pending_request->receiver_user_id && $check_pending_request) {

            // Update request_status from sent to denied.
            \App\FriendRequest::where('id', $id)->update([
                'request_status' => 'denied'
            ]);

            return response()->json([
                'message' => 'Friend Request has been successfully denied.',
            ], 200);
        }

        //if not right user, send error msg
        return response()->json(['Error Message' => 'Forbidden action.'], 403);
    }

    public function acceptRequest($id)
    {
        // get friend request by id
        $check_pending_request = \App\FriendRequest::where('request_status', 'sent')->find($id);

        //check if its the right user and if friend request exists
        if (Auth::user()->id === $check_pending_request->receiver_user_id && $check_pending_request) {

            // Update request to accepted.
            \App\FriendRequest::where('id', $id)->update([
                'request_status' => 'accepted'
            ]);

            return response()->json([
                'message' => 'Friend Request has been successfully accepted.',
            ], 200);

            // if the user is not right, send error message
            return response()->json(['Error Message' => 'Forbidden action.'], 403);
        }
    }
}
