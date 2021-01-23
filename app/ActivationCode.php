<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

class ActivationCode extends Model
{
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $hashids = new Hashids('ActivationCode', 8, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz');
            $strHash = $hashids->encode($model->id);

            $model->code = $strHash; 
            $model->save();
        });
    }
}
