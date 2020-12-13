<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = 'address';
    protected $fillable = [
        'customer_id' ,'address_line_1','address_line_2','city','state', 'pincode','address_type'
     ];
}
