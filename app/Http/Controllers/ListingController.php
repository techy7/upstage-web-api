<?php

namespace App\Http\Controllers;

use App\Listing;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ListingRequest;
use Illuminate\Support\Facades\DB;
use Auth;

class ListingController extends Controller
{

    protected $exceptData = [
        'id',
        'hash',
        'slug',
        'created_at',
        'updated_at',
        '_method'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->input('u', '');

        $listing = new Listing([
            'name' => '',
            'description' => '',
            "user_id" => $user_id,
            "editor_id" => '',
            "status" => 'pending',
            "address" => '',
            "state" => ''
        ]);

        $users = User::where('role', 'user')
                    ->select('first_name', 'last_name', 'id', 'email')
                    ->orderBy('first_name', 'asc')
                    ->get();
        $editors = User::where('role', 'editor')
                    ->select('first_name', 'last_name', 'id', 'email')
                    ->orderBy('first_name', 'asc')
                    ->get();

        return view('listings.create', compact('listing', 'users', 'editors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        // mark notification for this user if any
        DB::table('notifications')
            ->where('notifiable_id', Auth::user()->id)
            ->where('type', 'App\Notifications\ListingAdded')
            ->where('data', 'like', '%"hash":"'.$listing->hash.'"%') 
            ->whereNull('read_at')
            ->update(['read_at' => now()]); 
            
        $listing->load(['user', 'editor', 'items'=>function($i){
            $i->with(['editedItem', 'template'])
                ->withCount(['layers']);
        }]);  

        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        $users = User::where('role', 'user')
                    ->select('first_name', 'last_name', 'id', 'email')
                    ->orderBy('first_name', 'asc')
                    ->get();
        $editors = User::where('role', 'editor')
                    ->select('first_name', 'last_name', 'id', 'email')
                    ->orderBy('first_name', 'asc')
                    ->get();

        return view('listings.edit', compact('listing', 'users', 'editors'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function delete(Listing $listing)
    {
        return view('listings.delete', compact('listing'));
    }

    public function api_index(Request $request)
    {
        $strKeywords = $request->input('q', null);
        $strStatus = $request->input('status', null);
        
        $listings = Listing::ofKeywords($strKeywords)
            ->ofStatus($strStatus)
            ->orderBy('created_at', 'desc')
            ->with(['user'=>function($u){
                $u->select('id', 'first_name', 'last_name');
            }])
            ->withCount(['items'])
            ->paginate(20);
            
        return response()->json($listings);
    }

    public function api_store(ListingRequest $request)
    {
        $listing = Listing::create($request->except($this->exceptData));
        return response()->json($listing, 201);
    }

    public function api_show(Listing $listing)
    {
        return response()->json($listing);
    }

    public function api_update(ListingRequest $request, Listing $listing)
    {
        $data = $request->except($this->exceptData);
        $data['editor_id'] = $data['editor_id'] == 'null' ? null : $data['editor_id']; 

        $listing->update($data);
        return response()->json($listing, 200);
    }

    public function api_destroy(Listing $listing)
    {
        $listing->delete();
        return response()->json(null, 204);
    }
}
