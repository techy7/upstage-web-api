<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 

use App\User;

class ProfileController extends Controller
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

        return response()->json([
            'hash' => $user['hash'],
            'full_name' => $user['full_name'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'], 
            'contact_num' => $user['contact_num'],
            'avatar' => $user['avatar'],
            'slug' => $user['slug'],
            'fb_profile' => [
                'fb_id' => data_get($user, 'fb_id', ''),
                'fb_token' => data_get($user, 'fb_token', ''),
                'fb_avatar' => data_get($user, 'fb_avatar', ''),
                'fb_email' => data_get($user, 'fb_email', ''),
                'fb_name' => data_get($user, 'fb_name', ''),
            ],
            'is_verified' => $user['email_verified_at'] ? true : false
        ]);
    } 

    /**
     * Logout user session token
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $user = auth('api')->user();

        if(!isset($user['id']))
        {
            return response()->json([
                'error'   =>'Invalid Session',
                'status_code' => 401
            ], 401);
        }

        auth()->guard('api')->logout();
        return response()->json([
                'message'   =>'Successfully logged out',
                'status_code' => 200
            ], 200);
    }

    /**
     * Update user details and avatar
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // get user
        $user = auth('api')->user();

        // check if user
        if(!isset($user['id']))
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        // validate form inputs 
        $validator = Validator::make($request->all(), [
            'name' => 'required', 
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not update profile.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        // update user 
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_num' => $request->contact_num,
        ]);

        // if avatar file is presennt, update user's avatar too
        if($request->file('avatar'))
        {
            $filename = Str::slug($request->avatar->getClientOriginalName(), '-') . '.' .$request->avatar->extension(); 
            $avatar_stamp = time() . '_avatar_' . $filename; 
            $request->avatar->storeAs('avatars', $avatar_stamp); 
            $user->update(['avatar'=>$avatar_stamp]);
        }

        // return response
        return response()->json([
            'hash' => $user['hash'],
            'name' => $user['name'],
            'email' => $user['email'], 
            'contact_num' => $user['contact_num'],
            'avatar' => $user['avatar']
        ]);
    }

    /**
     * Use if avatar has to be uploaded alone
     *
     * @return \Illuminate\Http\Response
     */
    public function avatar(Request $request)
    {
        // get user
        $user = auth('api')->user();

        // check if user
        if(!isset($user['id']))
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        // validate form inputs 
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image', 
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not upload avatar.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        // save avatar
        if($request->file('avatar'))
        {
            $filename = Str::slug($request->avatar->getClientOriginalName(), '-') . '.' .$request->avatar->extension(); 
            $avatar_stamp = time() . '_avatar_' . $filename; 
            $request->avatar->storeAs('avatars', $avatar_stamp); 
            $user->update(['avatar'=>$avatar_stamp]);
        } 

        // return response
        return response()->json([
            'hash' => $user['hash'],
            'name' => $user['name'],
            'email' => $user['email'], 
            'contact_num' => $user['contact_num'],
            'avatar' => $user['avatar']
        ]);
    }
}
