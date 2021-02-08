<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\MessageUser;
use Notification;
use App\User;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function message_store(Request $request, Chat $chat)
    { 
        $validator = Validator::make($request->all(), [ 
            'msg' => 'required'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not send message.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $message = ChatMessage::create([
            'body' => $request->msg,
            'item_id' => $chat->item_id,
            'chat_id' => $chat->id,
            'user_id' => Auth::user()->id,
            'sender' => 'editor'
        ]); 

        $chat->update([
            'updated_at'=>now(),
            'user_status' => 'new',
            'editor_status' => 'seen'
        ]);

        $chat->load('item.listing');

        $user = User::find($chat->user_id);

        if($user) {
            $objMsg = array(
                "body" => $request->msg,
                "message_hash" => $message->hash,
                "project_hash" => $chat->item->listing->hash,
                "presentation_hash" => $chat->item->hash,
                "project_name" => $chat->item->listing->name,
                "presentation_name" => $chat->item->label,
                "chat_hash" => $chat->hash,
            );

            $user->notify(new MessageUser($objMsg));
        }

        return response()->json([
            'message' => $message->only(['body', 'hash', 'sender', 'updated_at', 'created_at', 'date']), 
            'status' =>'success',
            "user" => $objMsg,
            'status_code' => 200
        ], 200);
    }
}
