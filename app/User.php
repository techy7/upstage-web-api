<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Support\Str;
use Hashids\Hashids;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'full_name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plan() 
    {
        return $this->belongsTo(\App\Plan::class);
    }

    public function listings() 
    {
        return $this->hasMany(\App\Listing::class);
    }

    public function scopeOfKeywords($query, $strKeywords)
    {
        if($strKeywords)
        {
            return $query->orWhere('first_name', 'like', '%'.$strKeywords.'%')
                    ->orWhere('last_name', 'like', '%'.$strKeywords.'%')
                    ->orWhere('email', 'like', '%'.$strKeywords.'%')
                    ->orWhere('fb_name', 'like', '%'.$strKeywords.'%')
                    ->orWhere('contact_num', 'like', '%'.$strKeywords.'%');
        }

        return $query;
    }

    public function getFullNameAttribute()
    {
        if($this->fb_name) {
            return $this->fb_name;
        }

        return $this->first_name . ' ' . $this->last_name;
    }

    // we will use the hash column for type-hinting
    public function getRouteKeyName()
    {
        return 'hash';
    }

    // when a user was created, update its Hash value
    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $userhash = new Hashids('user', 5, 'abcd2ef3gh4j5k6mn7p8qr9stuvwxyz'); 
            $verifyhash = new Hashids('verify', 20, 'abcd2ef3gh4j5k6mn7p8qr9stuvwxyz'); 
            $strHash = $userhash->encode($model->id); 

            $model->hash = $strHash;
            $model->slug = Str::slug(str_replace(' ', '', $model->first_name . ' ' . $model->last_name), '') . '.' . $strHash;  
            $model->verify_token = $verifyhash->encode($model->id);
            $model->save();
        });
    }
}
