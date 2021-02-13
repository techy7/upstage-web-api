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

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;

class ChatController extends Controller
{
    private $chatMessage;
    private $chat;
    private $user;

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
        $chatSuccess = null;

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

            $this->chatMessage = $message;
            $this->chat = $chat;
            $this->user = $user;
            $chatSuccess = $this->notifWithFcmTopic();
        }

        return response()->json([
            'message' => $message->only(['body', 'hash', 'sender', 'updated_at', 'created_at', 'date']), 
            'status' =>'success',
            "user" => $objMsg,
            'status_code' => 200,
            'chatSuccess' => $chatSuccess
        ], 200);
    }

    protected function notifyWithFCM() {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('New Chat Message');
        $notificationBuilder->setBody($this->chatMessage->body)
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($this->user->hash, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();

        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $downstreamResponse->tokensWithError();

        return $downstreamResponse->numberSuccess();
    }


    protected function notifWithFcmTopic() {
        $notificationBuilder = new PayloadNotificationBuilder('New Chat Message');
        $notificationBuilder->setBody($this->chatMessage->body)
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([
            "body" => $this->chatMessage->body,
            "message_hash" => $this->chatMessage->hash,
            "project_hash" => $this->chat->item->listing->hash,
            "presentation_hash" => $this->chat->item->hash,
            "project_name" => $this->chat->item->listing->name,
            "presentation_name" => $this->chat->item->label,
            "chat_hash" => $this->chat->hash,
            "module"=>'new_chat_message'
        ]);

        // $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic($this->user->hash);

        $topicResponse = FCM::sendToTopic($topic, null, $notification, $data);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();

        return $topicResponse->isSuccess();
    }
}
