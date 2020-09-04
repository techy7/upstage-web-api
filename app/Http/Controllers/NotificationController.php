<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
 

class NotificationController extends Controller
{
    public function unreadnotifications()
    {
        return Auth::user()->unreadNotifications;  
    }

    public function allnotifications()
    {
        return Auth::user()->notifications;  
    }

    public function indexnotifications(Request $request)
    {
        if($request->status == 'unread'){
            return Auth::user()->unreadNotifications()->paginate(20); 
        } else {
            return Auth::user()->notifications()->paginate(20);
        }  
    }

    public function notifications()
    {
        return view('artists.notifications');
    } 
}

 
