<?php

namespace App\Http\Controllers;

use App\Item;
use App\EditedItem;
use App\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemEditRequest;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Notifications\ItemStarted;
use App\Notifications\ItemDone;
use Notification;
use App\User;

class ItemController extends Controller
{

    protected $exceptData = [
        'id',
        'hash',
        'slug',
        'created_at',
        'updated_at'
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Listing $listing)
    {
        $listing->load(['user']); 
        $item = new Item([
            'label' => '',
            'descriptions' => ''
        ]);

        return view('items.create', compact('item','listing'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing, Item $item)
    {
        $item->load(['editedItem', 'layers', 'template']);  
        return view('items.edit', compact('listing', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing, Item $item)
    {
        $item->load(['editedItem', 'layers', 'template', 'listing', 'chat.messages_asc', 'user']);

        return view('items.show', compact('listing', 'item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function delete(Listing $listing, Item $item)
    {
        return view('items.delete', compact('item', 'listing'));
    }

    public function api_index(Request $request)
    {
        $strKeywords = $request->input('q', null);
        
        $plans = Plan::ofKeywords($strKeywords)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return response()->json($plans);
    }

    public function api_store(Listing $listing, ItemRequest $request)
    {
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
            $request->file->storeAs('presentations', $file_stamp); 
            $item->update([
                'filename'=>$file_stamp,
                'mimetype'=>$request->file->getMimeType(),
            ]);
        } 

        return response()->json($item, 201);
    }

    public function api_update(ItemEditRequest $request, Listing $listing, Item $item)
    {
        $item->update([
            'label' => $request->label,
            'description' => $request->description
        ]);

        // save avatar
        if($request->file('file'))
        {
            $filename = Str::slug($request->file->getClientOriginalName(), '-') . '.' .$request->file->extension(); 
            $file_stamp = $listing->hash . time() . '_file_' . $filename; 
            $request->file->storeAs('presentations', $file_stamp); 
            $item->update([
                'filename'=>$file_stamp,
                'mimetype'=>$request->file->getMimeType(),
            ]);
        } 

        return response()->json($item, 200);
    }

    public function api_destroy(Listing $listing, Item $item)
    {
        Storage::delete('presentations/'.$item->filename);
        $item->delete();
        return response()->json(null, 204);
    }

    public function api_store_edited(Listing $listing, Item $item, Request $request)
    { 
        $validator = Validator::make($request->all(), [ 
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

        $filename = null;
        $mimetype = null; 

        // save avatar
        if($request->file('file'))
        {
            $filename = Str::slug($request->file->getClientOriginalName(), '-') . '.' .$request->file->extension(); 
            $file_stamp = $item->hash . time() . '_file_' . $filename; 
            $request->file->storeAs('editedpresentations', $file_stamp);  
            $filename = $file_stamp;
            $mimetype = $request->file->getMimeType();
        } 

        if(!$filename || !$mimetype) { 
            return response()->json([
                'error'   =>'Unauthorized',
                'status_code' => 401
            ], 401);
        }

        $editedItem = EditedItem::create([ 
            'filename' => $filename,
            'mimetype' => $mimetype,
            'listing_id' => $listing->id,
            'user_id' => $listing->user_id,
            'item_id' => $item->id,
            'editor_id' => Auth::user()->id,
        ]);

        return response()->json($editedItem, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function api_status(Listing $listing, Item $item, Request $request)
    {
        if(!in_array($request->status, array('pending', 'processing', 'done'))) {
            return response()->json([
                'error'   =>'Invalid status',
                'status_code' => 401
            ], 401);
        }

        $item->update(['status'=>$request->status]);
        $item->refresh();

        $user = User::find($item->user_id);

        if($user) {
            $item->load(['listing']);

            $objMsg = array(
                "new_status" => $item->status,
                "project_hash" => $item->listing->hash,
                "presentation_hash" => $item->hash,
                "project_name" => $item->listing->name,
                "presentation_name" => $item->label
            );

            if($item->status == 'processing') {
                $user->notify(new ItemStarted($objMsg));
            }

            if($item->status == 'done') {
                $user->notify(new ItemDone($objMsg));
            }
        }

        return response()->json([
            'item' => $item,
            'status' =>'success',
            'status_code' => 200
        ], 200);
    }
}
