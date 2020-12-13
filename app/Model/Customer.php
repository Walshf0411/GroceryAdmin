<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Customer extends Authenticatable implements JWTSubject
{
    use Notifiable, HasApiTokens;
    //
    protected $fillable = ['c_name',
    "mobile_number",
    "email_id",
    'wallet',
    'unique_code'];

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
            'c_name'=>$this->c_name,
            "mobile_number"=>$this->mobile_number,
            "email_id"=>$this->email_id,
            'wallet'=>$this->wallet,
            'unique_code' => $this->unique_code
        ];
    }
}
