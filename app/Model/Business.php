<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    protected $table = 'business';
    protected $fillable = [
        'product_id' ,'category_id','vendor_id','price','description', 'images'
     ];
}
