<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\User;
use JWTAuth;

class SocialController extends Controller
{
    public function facebook(Request $request)
    {
        // validate form inputs 
        $validator = Validator::make($request->all(), [
            'access_token' => 'required|string',
            'id' => 'required|string',
            'email' => 'required|string',
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Login to facebook failed.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $user = User::where('email', $request->email)->first(); 
        $fullname = explode(" ", $request->name);
        $lname = array_pop($fullname);
        $fname = implode(" ", $fullname); 

        if($user)
        {
            $user->update([ 
                'fb_id' => $request->id,
                'fb_token' => $request->access_token,
                'fb_avatar' => $request->picture,
                'fb_name' => $request->name,
                'fb_email' => $request->email,
                'first_name' => $fname, 
                'last_name' => $lname, 
            ]);
        } else {
            $user = User::firstOrCreate([
                'fb_id' => $request->id
            ],[ 
                'fb_token' => $request->access_token,
                'fb_avatar' => $request->picture,
                'fb_name' => $request->name,
                'fb_email' => $request->email,
                'first_name' => $fname, 
                'last_name' => $lname, 
                'email' => $request->email,
                'role' => 'user',
                'plan_id' => 1,
                'email_verified_at' => Carbon::now()
            ]); 
        } 


        $token = JWTAuth::fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'profile' => [ 
                'hash' => $user->hash,
                'full_name' => $user->full_name,
                'first_name' => data_get($user, 'first_name', ''),
                'last_name' => data_get($user, 'last_name', ''),
                'email' => $user->email, 
                'contact_num' => $user->contact_num,
                'avatar' => $user->avatar,
                'fb_profile' => [
                    'fb_id' => data_get($user, 'fb_id', ''),
                    'fb_token' => data_get($user, 'fb_token', ''),
                    'fb_avatar' => data_get($user, 'fb_avatar', ''),
                    'fb_email' => data_get($user, 'fb_email', ''),
                    'fb_name' => data_get($user, 'fb_name', ''),
                ],
                'slug' => $user->slug,
                'is_verified' => $user->email_verified_at ? true : false
            ]
        ]);

        

        // all good so return the token
        return response()->json(compact('token', 'user', 'user_hash')); 
    }

}


