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
            return $query->orWhere('name', 'like', '%'.$strKeywords.'%')
                    ->orWhere('email', 'like', '%'.$strKeywords.'%')
                    ->orWhere('contact_num', 'like', '%'.$strKeywords.'%');
        }

        return $query;
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
            $userhash = new Hashids('user', 5, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz'); 
            $verifyhash = new Hashids('verify', 20, 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz'); 
            $strHash = $userhash->encode($model->id); 

            $model->hash = $strHash;
            $model->slug = Str::slug($model->name, '') . '.' . $strHash;  
            $model->verify_token = $verifyhash->encode($model->id);
            $model->save();
        });
    }
}
