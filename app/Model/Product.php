<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
       'name' ,'category_id', 'images','unit'
    ];
}
