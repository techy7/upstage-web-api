<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Hashids\Hashids;

class EditedItem extends Model
{
    protected $guarded = ['id'];

    public function user() 
    {
        return $this->belongsTo(\App\User::class);
    }

    public function editor() 
    {
        return $this->belongsTo(\App\User::class, 'editor_id');
    }

    public function item() 
    {
        return $this->belongsTo(\App\Item::class, 'item_id');
    }

    public function listing() 
    {
        return $this->belongsTo(\App\Listing::class, 'listing_id');
    }
}
