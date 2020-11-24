<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
    protected $fillable = [
        'name' ,'shop_name','address', 'email_id','mobile_number','gst_number','rating'
     ];
}
