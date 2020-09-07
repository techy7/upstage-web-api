<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User; 
use App\Notifications\VerifyAccountWithCode;
use App\Notifications\UserNewSignup;
use Notification;
use Hashids;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function index(Request $request) 
    { 
        // return $app;
        // validate form inputs 
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
                // Rule::unique('users')->where(function ($query) use($app) {
                //     return $query->where('app_id', $app->id);
                // })
            ],
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required', 
            'last_name' => 'required', 
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not register.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        try {   
            $user = User::create([
                'email' => $request->email, 
                'first_name' => $request->first_name,  
                'last_name' => $request->last_name,  
                'contact_num' => $request->contact_num,  
                'password' => bcrypt($request->password),
                'plan_id' => 1
            ]); 
        } catch (Exception $e) {
            return Response::json(['message' => 'Something went wrong.'], 422); 
        }
 
        $resetCode = Hashids::connection('resetcode')
            ->encode($user->id . rand(10,99)); 
 
        $user->update(['verify_code'=>Str::upper($resetCode)]);
 
        Notification::route('mail', $request->email) 
                ->notify(new VerifyAccountWithCode(Str::upper($resetCode), $request->email));

        // get admin and notify
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new UserNewSignup($user)); 

        return response()->json([
            'message' => 'Account Created! Check your email and verify your account',
            'status' => 'success'
        ]);
    }

    public function verify(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 
            'code' => 'required|string',
            // 'email' => 'email|required|string'
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
            'message' => 'Unable to verify account',
            'errors' => ['code' => ['The code is invalid or expired']],
            'status' => 'error',
            'status_code' => 422
        ]; 

        // get the user
        $user = User::where('verify_code', $request->code)->first();

        if(!$user)
        {
            return response()->json($resetErr, 422);  
        }  

        // verify user
        $user->update([
            'email_verified_at' => now(),
            'verify_code' => null
        ]); 

        return response()->json([
            'message' => 'Account has been verified',
            'status' => 'success',
            'status_code' => 200
        ], 200); 
    }

    public function reverify(Request $request) 
    {  
        $validator = Validator::make($request->all(), [
            'email' => 'email|required|string'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not resend verification code.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        // get the user
        $user = User::where('email', $request->email)
            ->whereNotNull('verify_code')
            ->whereNull('email_verified_at')
            ->first();

        if(!$user) {
            return response()->json([
                'message' => 'Error. Email not found or the account is already verified', 
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }
 
        $resetCode = Hashids::connection('resetcode')
            ->encode($user->id . rand(10,99));  
 
        $user->update(['verify_code'=>Str::upper($resetCode)]);
 
        Notification::route('mail', $request->email) 
                ->notify(new VerifyAccountWithCode(Str::upper($resetCode), $request->email));

        // get admin and notify
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new UserNewSignup($user)); 

        return response()->json([
            'message' => 'Code sent! Check your email and verify your account',
            'status' => 'success'
        ]);
    }
}
