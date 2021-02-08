<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;   

class NotificationController extends Controller
{
    /**
     * Fetch user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $user = auth('api')->user();

        if(!isset($user['id']))
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $notifications = $user->sortedNotification()->paginate(20);

        $notifications->getCollection()->transform(function ($notif) {
            $module = data_get($notif, 'data.module');
            $status = $notif->read_at ? 'seen' : 'new';
            $data = array();

            if($module == 'new_chat_message') {
                $data["chat_hash"] = data_get($notif, 'data.chat_hash');
                $data["message_body"] = data_get($notif, 'data.body');
                $data["message_hash"] = data_get($notif, 'data.message_hash');
                $data["project_hash"] = data_get($notif, 'data.project_hash');
                $data["project_name"] = data_get($notif, 'data.project_name');
                $data["presentation_hash"] = data_get($notif, 'data.presentation_hash');
                $data["presentation_name"] = data_get($notif, 'data.presentation_name');
            } elseif ($module == 'presentation_processing') {
                $data["project_hash"] = data_get($notif, 'data.project_hash');
                $data["project_name"] = data_get($notif, 'data.project_name');
                $data["presentation_hash"] = data_get($notif, 'data.presentation_hash');
                $data["presentation_name"] = data_get($notif, 'data.presentation_name');
                $data["new_status"] = data_get($notif, 'data.new_status'); 
            } elseif ($module == 'presentation_done') {
                $data["project_hash"] = data_get($notif, 'data.project_hash');
                $data["project_name"] = data_get($notif, 'data.project_name');
                $data["presentation_hash"] = data_get($notif, 'data.presentation_hash');
                $data["presentation_name"] = data_get($notif, 'data.presentation_name');
                $data["new_status"] = data_get($notif, 'data.new_status'); 
            }


            
            return array(
                'type' => $module,
                'status' => $status,
                'data' => $data,
                'created_at' => $notif->created_at
            );
        });

        return response()->json($notifications);
    } 
}
