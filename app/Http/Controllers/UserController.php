<?php

namespace App\Http\Controllers;

use App\User;
use App\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{

    protected $exceptData = [
        'id',
        'hash',
        'slug',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::get();
        
        $user = new User([
            'name' => "",
            "email" => "",
            "password" => "",
            "avatar" => "",
            "role" => "user",
            "plan_id" => "",
            "contact_num" => ""
        ]);

        return view('users.create', compact('user', 'plans'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load(['plan', 'listings']);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $plans = Plan::get();
        return view('users.edit', compact('user', 'plans'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        return view('users.delete', compact('user'));
    }

    public function api_index(Request $request)
    {
        $strKeywords = $request->input('q', null);
        
        $users = User::ofKeywords($strKeywords)
            ->where('role', 'user')
            ->orderBy('name', 'asc')
            ->paginate(20);
            
        return response()->json($users);
    }

    public function api_store(UserRequest $request)
    {
        $user = User::create($request->except($this->exceptData));

        if($request->file('avatar'))
        {
            $filename = Str::slug($request->avatar->getClientOriginalName(), '-') 
                                . '.' .$request->avatar->extension(); 
            $avatar_stamp = time() . '_avatar_' . $filename;
            $request->avatar->storeAs('avatars', $avatar_stamp);
            $user->avatar = $avatar_stamp;
            $user->save();
        } 

        return response()->json($user, 201);
    }

    public function api_show(User $user)
    {
        return response()->json($user);
    }

    public function api_update(UserEditRequest $request, User $user)
    {
        $user->update($request->except($this->exceptData));

        if($request->file('avatar'))
        {
            $filename = Str::slug($request->avatar->getClientOriginalName(), '-') 
                                . '.' .$request->avatar->extension(); 
            $avatar_stamp = time() . '_avatar_' . $filename;
            $request->avatar->storeAs('avatars', $avatar_stamp);
            $user->avatar = $avatar_stamp;
            $user->save();
        } 

        return response()->json($user, 200);
    }

    public function api_destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function verify(User $user)
    { 
        if(!$user || $user->email_verified_at) {
            return redirect('/404');
        }

        $user->update(['email_verified_at' => Carbon::now()]); 
        return view('verified');
    }
}
