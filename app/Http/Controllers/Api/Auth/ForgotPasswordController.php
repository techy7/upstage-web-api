<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use Carbon\Carbon;
use Hashids;
use App\Notifications\ResetPasswordCode;
// use Notification;

class ForgotPasswordController extends Controller
{
    public function index(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Missing field.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $user = User::where('email', $request->email)->first();

        // if there is a valid user, add a password reset
        if($user)
        {
            $resetCode = Hashids::connection('resetcode')
                ->encode($user->id . Carbon::now()->format('His')); 

            if($resetCode)
            {
                // delete old reset requested thru API
                $oldResetCodes = DB::table('password_resets')->where([
                    'email' => $user->email,
                    'token' => 'api_reset'
                ])->delete();

                // create a new reset code
                $reset = DB::table('password_resets')->insert([
                    'email' => $request->email, 
                    'code' => $resetCode, 
                    'token' => 'api_reset',
                    'created_at' => Carbon::now()
                ]);

                // send the reset code to the email
                $user->notify(new ResetPasswordCode($resetCode));
            }
        } 

        return response()->json([
            'message' => 'Reset code was sent to ' . $request->email,
            'status' => 'success',
            'status_code' => 200
        ], 200);

    }
}
