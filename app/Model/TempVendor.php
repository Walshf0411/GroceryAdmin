<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TempVendor extends Model
{
    //
    protected $fillable = [
        'name', 'nickname' ,'shop_name','address', 'email_id','mobile_number','gst_number','message'
     ];
}
