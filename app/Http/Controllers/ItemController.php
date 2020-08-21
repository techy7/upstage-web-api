<?php

namespace App\Http\Controllers;

use App\Item;
use App\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemEditRequest;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;

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
        return view('items.edit', compact('listing', 'item'));
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
            $request->file->storeAs('items', $file_stamp); 
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
            $request->file->storeAs('items', $file_stamp); 
            $item->update([
                'filename'=>$file_stamp,
                'mimetype'=>$request->file->getMimeType(),
            ]);
        } 

        return response()->json($item, 200);
    }

    public function api_destroy(Listing $listing, Item $item)
    {
        Storage::delete('items/'.$item->filename);
        $item->delete();
        return response()->json(null, 204);
    }
}
