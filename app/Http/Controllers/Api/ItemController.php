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
use App\Layer;
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
            ->withCount(['layers'])
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
                "name" => $item->label,
                "description" => $item->description, 
                "status" => $item->status,
                "type" => $item->type, 
                "instruction" => $item->instruction, 
                "hash" => $item->hash,
                "slug" => $item->slug,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
                "file" => $objFile,
                "layers_count" => $item->layers_count,
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

        if($request->type == 'virtual_staging')
        { 
            if(!$request->file('layers') || !@count($request->file('layers'))) {
                return response()->json([
                    'message' => 'Could not add new room.',
                    'errors' => array(
                        'type'=>[ "Virtual Staging staging type requires at least 1 layer photo" ],
                        'layers'=>[ "Virtual Staging staging type requires at least 1 layer photo" ]
                    ),
                    'status' => 'error',
                    'status_code' => 422
                ], 422); 
            }
        } 

        $listing->loadCount(['items']);
        if($listing->items_count >= $listing->num_of_rooms) {
            return response()->json([
                'message' => 'Reached maximum number of rooms for this listings.',
                'errors' => array(
                    'num_of_rooms'=>[ "Reached maximum number of rooms for this listings" ]
                ),
                'status' => 'error',
                'status_code' => 422,
                'num_of_rooms' => $listing->num_of_rooms,
                'items_count' => $listing->items_count
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

        // save main file
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

        if($request->type == 'virtual_staging'){ 
            foreach ($request->file('layers') as $layer) { 
                $layerFilename = Str::slug($layer->getClientOriginalName(), '-') . '.' .$layer->extension(); 
                $layerStamp = $item->hash . time() . '_file_' . $layerFilename; 
                $layer->storeAs('layers', $layerStamp); 
                $objLayer = Layer::create([
                    'filename'=>$layerStamp,
                    'mimetype'=>$layer->getMimeType(),
                    'listing_id' => $listing->id,
                    'user_id' => $listing->user_id,
                    'item_id' => $item->id
                ]); 
            }
        }

        $item->load(['layers']);
        $itemLayers = [];

        foreach ($item->layers as $objLayer) {
            array_push($itemLayers, array(
                'mimetype' => $objLayer->mimetype,
                'filename' => $objLayer->filename,
                'hash' => $objLayer->hash,
                'file_url' => env('APP_URL').'/image/layers/150/150/'.$objLayer->filename
            ));
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
            ),
            'layers' => $itemLayers
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

        $item->load(['editedItem', 'layers']);

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

        $itemLayers = [];

        foreach ($item->layers as $objLayer) {
            array_push($itemLayers, array(
                'mimetype' => $objLayer->mimetype,
                'filename' => $objLayer->filename,
                'hash' => $objLayer->hash,
                'room_hash' => $item->hash,
                'listing_hash' => $listing->hash,
                'file_url' => env('APP_URL').'/image/layers/150/150/'.$objLayer->filename
            ));
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
            ),
            "layers" => $itemLayers
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
            // 'type' => 'required|in:'."photo,video,virtual_staging",
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
            // 'type' => $request->type,
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

        $item->load(['layers']);
        $itemLayers = [];

        foreach ($item->layers as $objLayer) {
            array_push($itemLayers, array(
                'mimetype' => $objLayer->mimetype,
                'filename' => $objLayer->filename,
                'hash' => $objLayer->hash,
                'room_hash' => $item->hash,
                'listing_hash' => $listing->hash,
                'file_url' => env('APP_URL').'/image/layers/150/150/'.$objLayer->filename
            ));
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
            "file" => array(
                "filename" => $item->filename,
                "mimetype" => $item->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/rooms/'.$item->filename,
                "thumbnail_url" => $thumb
            ),
            "layers" => $itemLayers
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

    public function layer_index(Listing $listing, Item $item)
    {
        $user = auth('api')->user(); 

        if(!isset($user['id']) || $item->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $item->load(['layers']);
        $itemLayers = [];

        foreach ($item->layers as $objLayer) {
            array_push($itemLayers, array(
                'mimetype' => $objLayer->mimetype,
                'filename' => $objLayer->filename,
                'hash' => $objLayer->hash,
                'room_hash' => $item->hash,
                'listing_hash' => $listing->hash,
                "file_url"=> env('APP_URL').'/image/layers/'.$objLayer->filename,
                "thumbnail_url"=> env('APP_URL').'/image/layers/150/150/'.$objLayer->filename
            ));
        }

        return response()->json($itemLayers, 200);
    }

    public function layer_store(Request $request, Listing $listing, Item $item)
    { 
        $user = auth('api')->user(); 

        if(!isset($user['id']) || $item->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $validator = Validator::make($request->all(), [
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

        // save main file
        if($request->file('file'))
        {
            $filename = Str::slug($request->file->getClientOriginalName(), '-') . '.' .$request->file->extension(); 
            $file_stamp = $listing->hash . time() . '_file_' . $filename; 
            $request->file->storeAs('layers', $file_stamp);  
        } 

        $objLayer = Layer::create([
            'filename'=>$file_stamp,
            'mimetype'=>$request->file->getMimeType(),
            'listing_id' => $listing->id,
            'user_id' => $listing->user_id,
            'item_id' => $item->id
        ]);

        return response()->json(array(
            "mimetype"=> $objLayer->mimetype,
            "filename"=> $objLayer->filename,
            "hash"=> $objLayer->hash,
            'room_hash' => $item->hash,
            'listing_hash' => $listing->hash,
            "file_url"=> env('APP_URL').'/image/layers/'.$objLayer->filename,
            "thumbnail_url"=> env('APP_URL').'/image/layers/150/150/'.$objLayer->filename
        ), 200);
    }

    public function layer_show(Listing $listing, Item $item, Layer $layer)
    {
        $user = auth('api')->user(); 

        if(!isset($user['id']) || $item->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        return response()->json(array(
            "mimetype"=> $layer->mimetype,
            "filename"=> $layer->filename,
            "hash"=> $layer->hash,
            'room_hash' => $item->hash,
            'listing_hash' => $listing->hash,
            "file_url"=> env('APP_URL').'/image/layers/'.$layer->filename,
            "thumbnail_url"=> env('APP_URL').'/image/layers/150/150/'.$layer->filename
        ), 200);
    }

    public function layer_delete(Listing $listing, Item $item, Layer $layer)
    {
        $user = auth('api')->user(); 

        if(!isset($user['id']) || $item->user_id != $user->id)
        {
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        } 

        Storage::delete('layers/'.$item->filename);
        $layer->delete();
        
        return response()->json([
            'message' => 'Layer was successfully deleted',
            'status_code' => 200
        ], 200);
    }
}
