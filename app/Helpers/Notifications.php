<?php

namespace App\Helpers;

use Auth;

class Notifications
{
	public static function unread($type)
	{
		if($type) {
			return Auth::user()->unreadNotifications->where('type', $type);  	
		}
		return Auth::user()->unreadNotifications;  
	}
}