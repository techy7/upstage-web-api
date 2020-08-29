<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User; 
use App\Notifications\VerifyEmail;
use Notification;
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

        // $user->sendEmailVerificationNotification();
        Notification::route('mail', $request->email) 
                ->notify(new VerifyEmail($user, $request->email)); 

        return response()->json([
            'message' => 'Account Created! Check your email and verify your account',
            'status' => 'success'
        ]);
    }
}
