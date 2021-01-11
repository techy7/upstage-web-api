<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Hashids\Hashids;

class Listing extends Model
{
    // This is renamed to "Project" in the display
    protected $guarded = ['id'];

    public function user() 
    {
        return $this->belongsTo(\App\User::class);
    }

    public function editor() 
    {
        return $this->belongsTo(\App\User::class, 'editor_id');
    }

    public function rawItems() 
    {
        return $this->hasMany(\App\Item::class)->where('status', 'raw');
    }

    public function first_item() 
    {
        return $this->hasOne(\App\Item::class, 'listing_id', 'id')
            ->orderBy('id', 'asc')
            // ->limit(1)
            ->where('mimetype', 'like', '%image%');
    }

    public function items() 
    {
        return $this->hasMany(\App\Item::class)->where('status', 'raw');
    }

    public function scopeOfKeywords($query, $strKeywords)
    {
        if($strKeywords)
        {
            return $query->orWhere('name', 'like', '%'.$strKeywords.'%')
                    ->orWhere('description', 'like', '%'.$strKeywords.'%');
        }

        return $query;
    }

    public function scopeOfStatus($query, $strStatus)
    {
        if($strStatus)
        {
            return $query->where('status', $strStatus);
        }

        return $query;
    }

    public function getRouteKeyName()
    {
        return 'hash';
    }

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $hashids = new Hashids('Listing', 8, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz');
            $strHash = $hashids->encode($model->id);

            $model->hash = $strHash;
            $model->slug = Str::slug($model->name, '-') . '-' . $strHash;
            $model->save();
        });
    }
}
