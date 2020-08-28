<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\User;

class ResetPasswordController extends Controller
{
    public function index(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'code' => 'required|string',
            'password' => 'required|string|confirmed|min:8'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Missing fields',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $resetErr = [
            'message' => 'Unable to reset password',
            'errors' => ['code' => ['The code is invalid or expired']],
            'status' => 'error',
            'status_code' => 422
        ];

        // delete old reset requested thru API
        $reset = DB::table('password_resets')->where([
            'email' => $request->email,
            'code' => $request->code,
            'token' => 'api_reset'
        ])->first();

        // check if there is reset for this user and not expired
        if(!$reset || Carbon::parse($reset->created_at)->addHours(24)->isPast())
        {
            return response()->json($resetErr, 422); 
        }

        // save new password
        $user = User::where('email', $request->email)->first();

        if(!$user)
        {
            return response()->json($resetErr = [
                'message' => 'User not found',
                'errors' => ['email' => ['We cannot find a user with that email']],
                'status' => 'error',
                'status_code' => 404
            ], 404);  
        } 

        $user->password = bcrypt($request->password);
        $user->save();

        // delete the reset code after saving new password
        DB::table('password_resets')->where([
            'email' => $request->email,
            'code' => $request->code,
            'token' => 'api_reset'
        ])->delete();

        return response()->json([
            'message' => 'Password has been reset',
            'status' => 'success',
            'status_code' => 200
        ], 200); 
    }
}
