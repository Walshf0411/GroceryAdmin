<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    //
    protected $fillable = [
        'subcategory_name', 'subcategory_image'
    ];

    protected $table = 'subcategories';
}
