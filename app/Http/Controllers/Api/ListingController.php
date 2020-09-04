<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use App\Http\Requests\ListingRequest;
use App\Notifications\ListingAdded;
use Notification;
use App\Listing;
use App\User;

class ListingController extends Controller
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

        $strKeywords = $request->input('q', null);
        $strStatus = $request->input('status', null);
        
        $listings = Listing::ofKeywords($strKeywords)
            ->where('user_id', $user['id'])
            ->ofStatus($strStatus)
            ->withCount(['items'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return response()->json($listings);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();

        if(!isset($user['id']))
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $validator = Validator::make($request->all(), [ 
            'name' => 'required'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not add new listing.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        // dd($request->all(), $request->description, $user);
        $listing = Listing::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $user['id'],
        ]);

        if($listing)
        {
            // get admin and notify
            $admins = User::where('role', 'admin')->get();
            Notification::send($admins, new ListingAdded($listing, $user)); 
        }

        if($user->fb_token){
            $fb_profile = [
                'fb_id' => data_get($user, 'fb_id', ''),
                'fb_token' => data_get($user, 'fb_token', ''),
                'fb_avatar' => data_get($user, 'fb_avatar', ''),
                'fb_email' => data_get($user, 'fb_email', ''),
                'fb_name' => data_get($user, 'fb_name', ''),
            ];
        } else {
            $fb_profile = null;
        }

        return response()->json(array(
            "name" => $listing->name,
            "description" => $listing->description,
            "hash" => $listing->hash,
            "slug" => $listing->slug,
            "created_at" => $listing->created_at,
            "updated_at" => $listing->updated_at,
            "user" => array(
                "first_name" => $user["first_name"],  
                "last_name" => $user["last_name"],
                "hash" => $user["hash"],
                "avatar" => $user["avatar"],  
                "fb_profile" => $fb_profile
            )
        ), 201);
    }

    public function show(Listing $listing)
    {
        $user = auth('api')->user();

        if(!isset($user['id']))
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $listing->load(['user', 'items']);
        $listingItems = [];

        foreach ($listing->items as $key => $item) {
            $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
            $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/items/150/150/'.$item->filename : null;

            array_push($listingItems, array(
                "label" => $item->label,
                "description" => $item->description, 
                "status" => $item->status,
                "hash" => $item->hash,
                "slug" => $item->slug,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
                "file" => array(
                    "filename" => $item->filename,
                    "mimetype" => $item->mimetype,
                    "file_url" => env('APP_URL').'/'.$folderUrl.'/items/'.$item->filename,
                    "thumbnail_url" => $thumb
                )
            ));
        }

        if($listing->user->fb_token){
            $fb_profile = [
                'fb_id' => data_get($listing->user, 'fb_id', ''),
                'fb_token' => data_get($listing->user, 'fb_token', ''),
                'fb_avatar' => data_get($listing->user, 'fb_avatar', ''),
                'fb_email' => data_get($listing->user, 'fb_email', ''),
                'fb_name' => data_get($listing->user, 'fb_name', ''),
            ];
        } else {
            $fb_profile = null;
        }

        
        return response()->json(array(
            "name" => $listing->name,
            "description" => $listing->description,
            "hash" => $listing->hash,
            "slug" => $listing->slug,
            "created_at" => $listing->created_at,
            "updated_at" => $listing->updated_at,
            "user" => array(
                "name" => $listing->user->name, 
                "hash" => $listing->user->hash,
                "avatar" => $listing->user->avatar,  
                "fb_profile" => $fb_profile
            ),
            "items" => $listingItems
        ));
    }

    public function update(Request $request, Listing $listing)
    {
        $user = auth('api')->user(); 

        if(!isset($user['id']) || $listing->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $validator = Validator::make($request->all(), [ 
            'name' => 'required'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not update listing.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }
        
        $listing->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(array(
            "name" => $listing->name,
            "description" => $listing->description,
            "hash" => $listing->hash,
            "slug" => $listing->slug,
            "created_at" => $listing->created_at, 
            "updated_at" => $listing->updated_at, 
            "user" => array("name" => $user["name"], "hash" => $user["hash"])
        ), 200);
    }

    public function destroy(Listing $listing)
    {
        $user = auth('api')->user(); 

        if(!isset($user['id']) || $listing->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $listing->delete();
        
        return response()->json([
            'message' => 'Listing was successfully deleted',
            'status_code' => 200
        ], 200);
    }
}
