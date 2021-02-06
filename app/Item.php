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

    public function template() 
    {
        return $this->belongsTo(\App\Template::class);
    }

    public function listing() 
    {
        return $this->belongsTo(\App\Listing::class);
    }

    public function editedItem() 
    {
        return $this->hasOne(\App\EditedItem::class, 'item_id')->orderBy('id', 'desc');
    }

    public function chat() 
    {
        return $this->hasOne(\App\Chat::class)->orderBy('updated_at', 'desc');
    }

    public function layers() 
    {
        return $this->hasMany(\App\Layer::class);
    }

    public function scopeOfKeywords($query, $strKeywords)
    {
        if($strKeywords)
        {
            return $query->orWhere('label', 'like', '%'.$strKeywords.'%')
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
            $model->slug = Str::slug($model->label, '-') . '-' . $strHash;
            $model->save();
        });
    }
}
