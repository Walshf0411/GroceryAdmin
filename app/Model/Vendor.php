<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject as ContractsJWTSubject;
use Tymonn\JWTAuth\Contracts\JWTSubject;
class Vendor extends Authenticatable implements ContractsJWTSubject
{
    //
    use Notifiable, HasApiTokens;

    protected $guard = 'vendor';

    protected $fillable = [
        'name' ,'shop_name','address', 'email_id','mobile_number','gst_number','rating'
     ];
     protected $hidden = [
        'password'
    ];

    protected $casts = [

        'created_at' => 'datetime',

        ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
