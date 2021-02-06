<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use App\Chat; 
use App\ChatMessage; 

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('api')->user();

        // dd($user['id']);

        if(!isset($user['id']))
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        } 

        $chats = Chat::where('user_id', $user->id)
            ->with(['item'=>function($i){
                $i->with(['listing', 'editedItem'])
                    ->withCount(['layers']);
            }])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $chats->getCollection()->transform(function ($chat) {
            $listing = $chat->item->listing;
            $item = $chat->item;

            $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
            $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/presentations/150/150/'.$item->filename : null;

            $objFile = array(
                "filename" => $item->filename,
                "mimetype" => $item->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/presentations/'.$item->filename,
                "thumbnail_url" => $thumb
            );

            if($item->editedItem) { 
                $folderUrl = strpos($item->editedItem->mimetype, 'image') !== false ? 'image' : 'video';
                $thumb = strpos($item->editedItem->mimetype, 'image') !== false ?
                             env('APP_URL').'/image/editedpresentations/150/150/'.$item->editedItem->filename : null;

                $objFile = array(
                    "filename" => $item->editedItem->filename,
                    "mimetype" => $item->editedItem->mimetype,
                    "file_url" => env('APP_URL').'/'.$folderUrl.'/editedpresentations/'.$item->editedItem->filename,
                    "thumbnail_url" => $thumb
                );
            } 

            return array(
                "user_status" => $chat->user_status,
                "hash" => $chat->hash,
                "created_at" => $chat->created_at,
                "updated_at" => $chat->updated_at,
                'presentation' => array(
                    "name" => $item->label,
                    "description" => $item->description, 
                    "status" => $item->status,
                    "type" => $item->type, 
                    "instruction" => $item->instruction, 
                    "hash" => $item->hash,
                    "slug" => $item->slug,
                    "created_at" => $item->created_at,
                    "updated_at" => $item->updated_at,
                    "file" => $objFile,
                    "media_assets_count" => $item->layers_count
                ),
                "project" => array(
                    "name" => $listing->name, 
                    "hash" => $listing->hash,
                    "slug" => $listing->slug,
                )
            ); 
        });

        return response()->json($chats);
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        $user = auth('api')->user();

        if(!isset($user['id']) || $chat->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $chat->load(['item'=>function($i){
            $i->with(['listing', 'editedItem'])
                ->withCount(['layers']);
        }]);

        $listing = $chat->item->listing;
        $item = $chat->item;

        $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
        $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/presentations/150/150/'.$item->filename : null;

        $objFile = array(
            "filename" => $item->filename,
            "mimetype" => $item->mimetype,
            "file_url" => env('APP_URL').'/'.$folderUrl.'/presentations/'.$item->filename,
            "thumbnail_url" => $thumb
        );

        if($item->editedItem) { 
            $folderUrl = strpos($item->editedItem->mimetype, 'image') !== false ? 'image' : 'video';
            $thumb = strpos($item->editedItem->mimetype, 'image') !== false ?
                         env('APP_URL').'/image/editedpresentations/150/150/'.$item->editedItem->filename : null;

            $objFile = array(
                "filename" => $item->editedItem->filename,
                "mimetype" => $item->editedItem->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/editedpresentations/'.$item->editedItem->filename,
                "thumbnail_url" => $thumb
            );
        } 

        $chatObj = array(
            "user_status" => $chat->user_status,
            "hash" => $chat->hash,
            "created_at" => $chat->created_at,
            "updated_at" => $chat->updated_at,
            'presentation' => array(
                "name" => $item->label,
                "description" => $item->description, 
                "status" => $item->status,
                "type" => $item->type, 
                "instruction" => $item->instruction, 
                "hash" => $item->hash,
                "slug" => $item->slug,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
                "file" => $objFile,
                "media_assets_count" => $item->layers_count
            ),
            "project" => array(
                "name" => $listing->name, 
                "hash" => $listing->hash,
                "slug" => $listing->slug,
            )
        );  
        return response()->json($chatObj);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function message_index(Chat $chat)
    {
        $user = auth('api')->user();

        if(!isset($user['id']) || $chat->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $messages = ChatMessage::where('chat_id', $chat->id)
            ->select('sender', 'hash', 'body', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($messages);
    }

    public function message_store(Request $request, Chat $chat)
    {
        $user = auth('api')->user();

        if(!isset($user['id']) || $chat->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $validator = Validator::make($request->all(), [ 
            'body' => 'required'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not add new room.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $message = ChatMessage::create([
            'body' => $request->body,
            'item_id' => $chat->item_id,
            'chat_id' => $chat->id,
            'user_id' => $chat->user_id,
            'sender' => 'user'
        ]);

        return response()->json($message->only(['body', 'hash', 'sender', 'updated_at', 'created_at']));
    }
}
