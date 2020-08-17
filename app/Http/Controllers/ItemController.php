<?php

namespace App\Http\Controllers;

use App\Item;
use App\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Str; 

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
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function delete(Plan $plan)
    {
        return view('plans.delete', compact('plan'));
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

    public function api_show(Plan $plan)
    {
        return response()->json($plan);
    }

    public function api_update(PlanRequest $request, Plan $plan)
    {
        $plan->update($request->except($this->exceptData));
        return response()->json($plan, 200);
    }

    public function api_destroy(Plan $plan)
    {
        $plan->delete();
        return response()->json(null, 204);
    }
}
