<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TempProduct2 extends Model
{
    protected $table = 'tempprod2';
    //
    protected $fillable = [
    'vendor_id', 'name', 'description', 'price', 'images', 'created_at', 'updated_at'
    ];
}
