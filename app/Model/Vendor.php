<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Vendor extends Authenticatable implements JWTSubject
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


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [
        'name'=> $this->name ,
        'shop_name' => $this->shop_name,
        'address' => $this->address,
        'email_id' => $this->email_id,
        'mobile_number'=> $this->mobile_number,
        'gst_number'=> $this->gst_number,
        'rating'=> $this->rating
    ];
    }
}
