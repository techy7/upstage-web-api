<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use App\Http\Requests\ListingRequest;
use App\Listing;

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

        return response()->json(array(
            "name" => $listing->name,
            "description" => $listing->description,
            "hash" => $listing->hash,
            "slug" => $listing->slug,
            "created_at" => $listing->created_at,
            "updated_at" => $listing->updated_at,
            "user" => array("name" => $user["name"], "hash" => $user["hash"])
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

        $listing->load(['user']);
        
        return response()->json(array(
            "name" => $listing->name,
            "description" => $listing->description,
            "hash" => $listing->hash,
            "slug" => $listing->slug,
            "created_at" => $listing->created_at,
            "updated_at" => $listing->updated_at,
            "user" => array(
                "name" => $listing->user->name, 
                "hash" => $listing->user->hash
            )
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
