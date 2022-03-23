<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'category_name', 'category_image'
    ];

    public function subCategories() {
        return $this->hasMany(SubCategory::class);
    }
}
