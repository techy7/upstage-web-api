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
            ->orderBy('created_at', 'desc')
            ->paginate(20); 

        $items->getCollection()->transform(function ($item) {
            $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
            $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/items/150/150/'.$item->filename : null;

            return array(
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
            );

            // return $item;
        });


        // $items->getCollection()->transform((function($model) {
        //     return $model;
        //     $folderUrl = strpos($model->mimetype, 'image') !== false ? 'image' : 'video';
        //     $thumb = strpos($model->mimetype, 'image') !== false ? env('APP_URL').'/image/items/150/150/'.$model->filename : null;

        //     // return array(
        //     //     "label" => $model->label,
        //     //     "description" => $model->description, 
        //     //     "status" => $model->status,
        //     //     "hash" => $model->hash,
        //     //     "slug" => $model->slug,
        //     //     "created_at" => $model->created_at,
        //     //     "updated_at" => $model->updated_at,
        //     //     "file" => array(
        //     //         "filename" => $model->filename,
        //     //         "mimetype" => $model->mimetype,
        //     //         "file_url" => env('APP_URL').'/'.$folderUrl.'/items/'.$model->filename,
        //     //         "thumbnail_url" => $thumb
        //     //     )
        //     // );
        // });
            
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
            'label' => 'required',
            'file' => 'required|file'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not add new listing.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }

        $item = Item::create([
            'label' => $request->label,
            'description' => $request->description,
            'status' => 'raw',
            'listing_id' => $listing->id,
            'user_id' => $listing->user_id
        ]);

        // save avatar
        if($request->file('file'))
        {
            $filename = Str::slug($request->file->getClientOriginalName(), '-') . '.' .$request->file->extension(); 
            $file_stamp = $listing->hash . time() . '_file_' . $filename; 
            $request->file->storeAs('items', $file_stamp); 
            $item->update([
                'filename'=>$file_stamp,
                'mimetype'=>$request->file->getMimeType(),
            ]);
        } 

        $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
        $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/items/150/150/'.$item->filename : null;

        return response()->json(array(
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

        $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
        $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/items/150/150/'.$item->filename : null;
        
        return response()->json(array(
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
            'label' => 'required'
        ]);

        if ($validator->fails()) {  
            return response()->json([
                'message' => 'Could not update listing.',
                'errors' => $validator->errors(),
                'status' => 'error',
                'status_code' => 422
            ], 422); 
        }
        
        $item->update([
            'label' => $request->label,
            'description' => $request->description
        ]);

        // save avatar
        if($request->file('file'))
        {
            $filename = Str::slug($request->file->getClientOriginalName(), '-') . '.' .$request->file->extension(); 
            $file_stamp = $listing->hash . time() . '_file_' . $filename; 
            $request->file->storeAs('items', $file_stamp); 
            $item->update([
                'filename'=>$file_stamp,
                'mimetype'=>$request->file->getMimeType(),
            ]);
        } 

        $folderUrl = strpos($item->mimetype, 'image') !== false ? 'image' : 'video';
        $thumb = strpos($item->mimetype, 'image') !== false ? env('APP_URL').'/image/items/150/150/'.$item->filename : null;
        
        return response()->json(array(
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
            'message' => 'Item was successfully deleted',
            'status_code' => 200
        ], 200);
    }
}
