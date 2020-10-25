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
            ->with(['first_item.editedItem', 'user', 'items'=>function($i){
                $i->limit(4);
            }])
            ->withCount(['items'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $listings->getCollection()->transform(function ($list) {   
            $first_item = null;

            if($list->first_item) {
                $objFile = array(
                    "filename" => $list->first_item->filename,
                    "mimetype" => $list->first_item->mimetype,
                    "file_url" => env('APP_URL').'/image/items/'.$list->first_item->filename,
                    "thumbnail_url" => env('APP_URL').'/image/items/150/150/'.$list->first_item->filename
                );

                if($list->first_item->editedItem) { 
                    $objFile = array(
                        "filename" => $list->first_item->editedItem->filename,
                        "mimetype" => $list->first_item->editedItem->mimetype,
                        "file_url" => env('APP_URL').'/image/editeditems/'.$list->first_item->editedItem->filename,
                        "thumbnail_url" => env('APP_URL').'/image/editeditems/150/150/'.$list->first_item->editedItem->filename
                    );
                }

                $first_item = array(
                    "name" => $list->first_item->label,
                    "description" => $list->first_item->description, 
                    "status" => $list->first_item->status,
                    "hash" => $list->first_item->hash,
                    "slug" => $list->first_item->slug,
                    "type" => $list->first_item->type,
                    "instruction" => $list->first_item->instruction,
                    "created_at" => $list->first_item->created_at,
                    "updated_at" => $list->first_item->updated_at,
                    "file" => $objFile
                );
            }

            if($list->user->fb_token){
                $fb_profile = [
                    'fb_id' => data_get($list->user, 'fb_id', ''),
                    'fb_token' => data_get($list->user, 'fb_token', ''),
                    'fb_avatar' => data_get($list->user, 'fb_avatar', ''),
                    'fb_email' => data_get($list->user, 'fb_email', ''),
                    'fb_name' => data_get($list->user, 'fb_name', ''),
                ];
            } else {
                $fb_profile = null;
            }

            // assemble the four rooms
            $listingRooms = [];

            foreach ($list->items as $key => $item) {
                $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
                $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/items/150/150/'.$item->filename : null;

                $objFile = array(
                    "filename" => $item->filename,
                    "mimetype" => $item->mimetype,
                    "file_url" => env('APP_URL').'/'.$folderUrl.'/items/'.$item->filename,
                    "thumbnail_url" => $thumb
                );

                if($item->editedItem) { 
                    $folderUrl = strpos($item->editedItem->mimetype, 'image') !== false ? 'image' : 'video';
                    $thumb = strpos($item->editedItem->mimetype, 'image') !== false ?
                                 env('APP_URL').'/image/editeditems/150/150/'.$item->editedItem->filename : null;

                    $objFile = array(
                        "filename" => $item->editedItem->filename,
                        "mimetype" => $item->editedItem->mimetype,
                        "file_url" => env('APP_URL').'/'.$folderUrl.'/editeditems/'.$item->editedItem->filename,
                        "thumbnail_url" => $thumb
                    );
                }

                array_push($listingRooms, array(
                    "name" => $item->label,
                    "description" => $item->description, 
                    "status" => $item->status,
                    "hash" => $item->hash,
                    "slug" => $item->slug,
                    "type" => $item->type,
                    "instruction" => $item->instruction,
                    "created_at" => $item->created_at,
                    "updated_at" => $item->updated_at,
                    "file" => $objFile
                ));
            }

            $shareURL = url('/user/'.$list->user->slug.'/'.$list->hash);

            return array(
                "name" => $list->name,
                "description" => $list->description,
                "address" => $list->address,
                "state" => $list->state,
                "num_of_rooms" => $list->num_of_rooms,
                "status" => $list->status,
                "created_at" => $list->created_at,
                "updated_at" => $list->updated_at,
                "hash" => $list->hash,
                "slug" => $list->slug,
                "rooms_count" => $list->items_count,
                "first_room" => $first_item,
                "rooms" => $listingRooms,
                "share_url" => $shareURL,
                "user" => array(
                    "name" => $list->user->full_name, 
                    "hash" => $list->user->hash,
                    "avatar" => $list->user->avatar,  
                    "fb_profile" => $fb_profile
                ),
            );

            // return $item;
        }); 
            
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
            'name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'num_of_rooms' => 'required|min:1|max:10|integer'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not add new listing.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $user->load(['plan'])->loadCount(['listings']);

        if($user->plan->limit_list <= $user->listings_count) {
            return response()->json([
                'message' => 'Reached maximum number of listings for your plan', 
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $listing = Listing::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $user['id'],
            'address' => $request->address,
            'state' => $request->state,
            'num_of_rooms' => $request->num_of_rooms,
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
            "address" => $listing->address,
            "state" => $listing->state,
            "num_of_rooms" => $listing->num_of_rooms,
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

            $objFile = array(
                "filename" => $item->filename,
                "mimetype" => $item->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/items/'.$item->filename,
                "thumbnail_url" => $thumb
            );

            if($item->editedItem) { 
                $folderUrl = strpos($item->editedItem->mimetype, 'image') !== false ? 'image' : 'video';
                $thumb = strpos($item->editedItem->mimetype, 'image') !== false ?
                             env('APP_URL').'/image/editeditems/150/150/'.$item->editedItem->filename : null;

                $objFile = array(
                    "filename" => $item->editedItem->filename,
                    "mimetype" => $item->editedItem->mimetype,
                    "file_url" => env('APP_URL').'/'.$folderUrl.'/editeditems/'.$item->editedItem->filename,
                    "thumbnail_url" => $thumb
                );
            }

            array_push($listingItems, array(
                "name" => $item->label,
                "description" => $item->description, 
                "status" => $item->status,
                "hash" => $item->hash,
                "slug" => $item->slug,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
                "file" => $objFile
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
            "address" => $listing->address,
            "state" => $listing->state,
            "num_of_rooms" => $listing->num_of_rooms,
            "hash" => $listing->hash,
            "slug" => $listing->slug,
            "created_at" => $listing->created_at,
            "updated_at" => $listing->updated_at,
            "user" => array(
                "name" => $listing->user->full_name, 
                "hash" => $listing->user->hash,
                "avatar" => $listing->user->avatar,  
                "fb_profile" => $fb_profile
            ),
            "rooms" => $listingItems
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
