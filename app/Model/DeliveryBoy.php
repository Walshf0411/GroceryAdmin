<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class DeliveryBoy extends Authenticatable implements JWTSubject
{
    //
    use Notifiable, HasApiTokens;

    protected $table = 'deliveryboy';

    protected $guard = 'deliveryboy';

    protected $fillable = [
        'name' ,'phoneno', 'email', 'is_available'
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
        'phoneno' => $this->phoneno,
        'email' => $this->email,
        'is_available'=> $this->is_available
    ];
    }
    public function isAvailable() {
        return $this->is_available >= 0;
    }
}
