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

class UserController extends Controller
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
            'first_name' => "",
            'last_name' => "",
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
        // mark notification for this user if any
        DB::table('notifications')
            ->where('notifiable_id', Auth::user()->id)
            ->where('type', 'App\Notifications\UserNewSignup')
            ->where('data', 'like', '%"hash":"'.$user->hash.'"%') 
            ->whereNull('read_at')
            ->update(['read_at' => now()]);   

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
            ->with(['plan'])
            ->withCount(['listings'])
            ->orderBy('first_name', 'asc')
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

    public function profile_public($slug) {
        $profile = User::where('slug', $slug)->with(['listings.first_item'])->first(); 
        // dd($profile);

        // $listingx = Listing::with(['first_item', 'items'])
        //             // ->where('hash', 'm806w1pg')
        //             ->get();
        // dd($listingx->toArray());

        if(!$profile) {
            return redirect('404');
        }

        return view('profile.index', compact('profile'));
    }
    public function profile_listing($slug, $list) {
        $profile = User::where('slug', $slug)->first();
        if(!$profile) {
            return redirect('404');
        }

        $listing = Listing::where('hash', $list)
                    ->where('user_id', $profile->id)
                    ->with(['items'])
                    ->first();
        
        if(!$listing) {
            return redirect('404');
        }

        return view('profile.listing', compact('profile', 'listing'));
    }
}
