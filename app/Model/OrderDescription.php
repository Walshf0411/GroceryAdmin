<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDescription extends Model
{
    //
    protected $table = 'orderdescription';

    protected $fillable = [
        'order_id','vendor_id' ,'product_id', 'count'
     ];

}
