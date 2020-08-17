<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Hashids\Hashids;

class Item extends Model
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
            $hashids = new Hashids('Item', 8, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz');
            $strHash = $hashids->encode($model->id);

            $model->hash = $strHash;
            $model->slug = Str::slug($model->name, '-') . '-' . $strHash;
            $model->save();
        });
    }
}
