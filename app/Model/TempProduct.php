<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TempProduct extends Model
{
    //
    protected $fillable = [
        'name' ,'vendor_id','category_id', 'images','unit'
     ];
}
