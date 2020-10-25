<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Hashids\Hashids;

class Layer extends Model
{
    protected $guarded = ['id'];

    public function user() 
    {
        return $this->belongsTo(\App\User::class);
    }

    public function item() 
    {
        return $this->belongsTo(\App\Item::class, 'item_id');
    }

    public function listing() 
    {
        return $this->belongsTo(\App\Listing::class, 'listing_id');
    }

    public function getRouteKeyName()
    {
        return 'hash';
    }

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $hashids = new Hashids('Layer', 8, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz');
            $strHash = $hashids->encode($model->id);

            $model->hash = $strHash; 
            $model->save();
        });
    }
}
