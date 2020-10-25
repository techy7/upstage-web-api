<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use App\Http\Requests\ListingRequest;
use App\Listing;
use App\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Fetch user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Listing $listing)
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
        
        $items = Item::ofKeywords($strKeywords)
            ->where('user_id', $user['id'])
            ->where('listing_id', $listing->id)
            ->ofStatus($strStatus) 
            ->with(['editedItem'])
            ->orderBy('created_at', 'desc')
            ->paginate(20); 

        $items->getCollection()->transform(function ($item) use($listing) {
            $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
            $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/rooms/150/150/'.$item->filename : null;

            $objFile = array(
                "filename" => $item->filename,
                "mimetype" => $item->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/rooms/'.$item->filename,
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

            return array(
                "label" => $item->label,
                "description" => $item->description, 
                "status" => $item->status,
                "type" => $item->type, 
                "instruction" => $item->instruction, 
                "hash" => $item->hash,
                "slug" => $item->slug,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
                "file" => $objFile,
                "listing" => array(
                    "name" => $listing->name, 
                    "hash" => $listing->hash,
                    "slug" => $listing->slug,
                )
            ); 
        }); 
            
        return response()->json($items);
    }

    public function store(Request $request, Listing $listing)
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
            'name' => 'required',
            'type' => 'required|in:'."photo,video,virtual_staging",
            'file' => 'required|file'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not add new room.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $item = Item::create([
            'label' => $request->name,
            'description' => $request->description,
            'status' => 'raw',
            'listing_id' => $listing->id,
            'user_id' => $listing->user_id,
            'type' => $request->type,
            'instruction' => $request->instruction,
        ]);

        // save avatar
        if($request->file('file'))
        {
            $filename = Str::slug($request->file->getClientOriginalName(), '-') . '.' .$request->file->extension(); 
            $file_stamp = $listing->hash . time() . '_file_' . $filename; 
            $request->file->storeAs('rooms', $file_stamp); 
            $item->update([
                'filename'=>$file_stamp,
                'mimetype'=>$request->file->getMimeType(),
            ]);
        } 

        $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
        $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/rooms/150/150/'.$item->filename : null;

        return response()->json(array(
            "name" => $item->label,
            "description" => $item->description, 
            "status" => $item->status,
            "hash" => $item->hash,
            "slug" => $item->slug,
            "type" => $item->type, 
            "instruction" => $item->instruction, 
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at,
            "file" => array(
                "filename" => $item->filename,
                "mimetype" => $item->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/rooms/'.$item->filename,
                "thumbnail_url" => $thumb
            )
        ), 201);
    }

    public function show(Listing $listing, Item $item)
    {
        $user = auth('api')->user();

        if(!isset($user['id']) || $item->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }  

        $item->load(['editedItem']);

        $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
        $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/rooms/150/150/'.$item->filename : null;

        $objFile = array(
            "filename" => $item->filename,
            "mimetype" => $item->mimetype,
            "file_url" => env('APP_URL').'/'.$folderUrl.'/rooms/'.$item->filename,
            "thumbnail_url" => $thumb
        );

        if($item->editedItem) { 
            $folderUrl = strpos($item->editedItem->mimetype, 'image') !== false ? 'image' : 'video';
            $thumb = strpos($item->editedItem->mimetype, 'image') !== false ?
                         env('APP_URL').'/image/editeditems/150/150/'.$item->editedItem->filename : null;

            $objFile = array(
                "filename" => $item->editedItem->filename,
                "mimetype" => $item->editedItem->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/editedrooms/'.$item->editedItem->filename,
                "thumbnail_url" => $thumb
            );
        }
        
        return response()->json(array(
            "name" => $item->label,
            "description" => $item->description, 
            "type" => $item->type, 
            "instruction" => $item->instruction, 
            "status" => $item->status,
            "hash" => $item->hash,
            "slug" => $item->slug,
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at,
            "file" => $objFile,
            "listing" => array(
                "name" => $listing->name, 
                "hash" => $listing->hash,
                "slug" => $listing->slug,
            )
        ));
    }

    public function update(Request $request, Listing $listing, Item $item)
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
            'name' => 'required',
            'type' => 'required|in:'."photo,video,virtual_staging",
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not update room.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }
        
        $item->update([
            'label' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'instruction' => $request->instruction
        ]);

        // save avatar
        if($request->file('file'))
        {
            $filename = Str::slug($request->file->getClientOriginalName(), '-') . '.' .$request->file->extension(); 
            $file_stamp = $listing->hash . time() . '_file_' . $filename; 
            $request->file->storeAs('rooms', $file_stamp); 
            $item->update([
                'filename'=>$file_stamp,
                'mimetype'=>$request->file->getMimeType(),
            ]);
        } 

        $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
        $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/rooms/150/150/'.$item->filename : null;
        
        return response()->json(array(
            "name" => $item->label,
            "description" => $item->description, 
            "type" => $item->type, 
            "instruction" => $item->instruction, 
            "status" => $item->status,
            "hash" => $item->hash,
            "slug" => $item->slug,
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at,
            "file" => array(
                "filename" => $item->filename,
                "mimetype" => $item->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/rooms/'.$item->filename,
                "thumbnail_url" => $thumb
            )
        ));
    }

    public function destroy(Listing $listing, Item $item)
    {
        $user = auth('api')->user(); 

        if(!isset($user['id']) || $item->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        Storage::delete('items/'.$item->filename);
        $item->delete();
        
        return response()->json([
            'message' => 'Room was successfully deleted',
            'status_code' => 200
        ], 200);
    }
}
