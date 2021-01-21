<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Hashids\Hashids;

class Template extends Model
{
    const TYPES = ['Image', 'Video', 'Staging'];

    const OPTIONS = [
        'Image'  => array('Img One', 'Img Two', 'Img Three', 'Img Four'), 
        'Video'  => array('Vid One', 'Vid Two', 'Vid Three', 'Vid Four'),
        'Staging'  => array('Stg One', 'Stg Two', 'Stg Three', 'Stg Four'),
    ];

    protected $guarded = ['id'];

    public function scopeOfKeywords($query, $strKeywords)
    {
        if($strKeywords)
        {
            return $query->orWhere('name', 'like', '%'.$strKeywords.'%')
                    ->orWhere('description', 'like', '%'.$strKeywords.'%');
        }

        return $query;
    } 

    public function scopeOfType($query, $type)
    {
        if($type)
        {
            return $query->where('type', $type);
        }

        return $query;
    }

    public function scopeOfCategory($query, $category)
    {
        if($category)
        {
            return $query->where('category', $category);
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
            $hashids = new Hashids('Plan', 8, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz');
            $strHash = $hashids->encode($model->id);

            $model->hash = $strHash;
            $model->slug = Str::slug($model->name, '-') . '-' . $strHash;
            $model->save();
        });
    }
}
