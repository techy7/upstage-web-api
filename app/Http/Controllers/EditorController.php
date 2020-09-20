<?php

namespace App\Http\Controllers;

use App\User;
use App\Plan;
use App\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;

class EditorController extends Controller
{

    protected $exceptData = [
        'id',
        'hash',
        'slug',
        'email_verified_at',
        'created_at',
        'updated_at',
        'full_name'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('editors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $editor = new User([
            'first_name' => "",
            'last_name' => "",
            "email" => "",
            "password" => "",
            "avatar" => "",
            "role" => "editor",
            "plan_id" => "",
            "contact_num" => ""
        ]);

        return view('editors.create', compact('editor'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $editor)
    { 
        $editor->load(['listedits'=>function($l) {
            $l->with(['user', 'first_item']);
        }]); 
        return view('editors.show', compact('editor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $editor)
    { 
        return view('editors.edit', compact('editor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $editor)
    {
        return view('editors.delete', compact('editor'));
    }

    public function api_index(Request $request)
    {
        $strKeywords = $request->input('q', null);
        $strSortBy = $request->input('sort', 'first_name');
        $strSortDir = $strSortBy == 'listedits_count' ? 'desc' : 'asc';
        
        $users = User::ofKeywords($strKeywords)
            ->where('role', 'editor') 
            ->withCount(['listedits'])
            ->orderBy($strSortBy, $strSortDir)
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
 
}
