<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class LoginController extends Controller
{
    public function index(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->guard('api')->attempt($credentials)) 
        {
            return response()->json([
                'error'   =>'Invalid credentials',
                'status_code' => 422
            ], 422);
        } 

        $user = User::where('email', $request->email)
            ->where('role', 'user')
            ->first();

        if(!$user)
        {
            return response()->json([
                'error'   =>'Unauthorized access',
                'status_code' => 401
            ], 401);
        }

        if(!$user->email_verified_at)
        {
            return response()->json([
                'error'   =>'Email not verified',
                'status_code' => 401
            ], 401);
        }

        if($user->fb_token){
            $fb_profile = [
                'fb_id' => data_get($user, 'fb_id', ''),
                'fb_token' => data_get($user, 'fb_token', ''),
                'fb_avatar' => data_get($user, 'fb_avatar', ''),
                'fb_email' => data_get($user, 'fb_email', ''),
                'fb_name' => data_get($user, 'fb_name', ''),
            ];
        } else {
            $fb_profile = null;
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'profile' => [ 
                'hash' => $user->hash,
                'full_name' => $user->full_name,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email, 
                'contact_num' => $user->contact_num,
                'avatar' => $user->avatar,
                'slug' => $user->slug,
                'is_verified' => $user->email_verified_at ? true : false,
                'fb_profile' => $fb_profile,
            ]
        ]);
    }

}
