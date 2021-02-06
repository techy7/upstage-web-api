<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Hashids\Hashids;

class ChatMessage extends Model
{
    protected $guarded = ['id'];

    protected $appends = [
        'date'
    ];

    public function user() 
    {
        return $this->belongsTo(\App\User::class);
    }

    public function item() 
    {
        return $this->belongsTo(\App\Item::class);
    }

    public function chat() 
    {
        return $this->belongsTo(\App\Chat::class);
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('M d, Y h:i a');
    }

    public function getRouteKeyName()
    {
        return 'hash';
    }

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $hashids = new Hashids('ChatMessage', 8, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz');
            $strHash = $hashids->encode($model->id);

            $model->hash = $strHash;
            $model->slug = Str::slug($model->label, '-') . '-' . $strHash;
            $model->save();
        });
    }
}
