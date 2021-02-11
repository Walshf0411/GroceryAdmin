<?php

namespace App\Service;

use App\Model\TempProduct2;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class Product2Service{
    public function getAllVendorProducts($id){
        return DB::select('select * from product2 where vendor_id = ? ', [$id]);
    }

    public function listProduct(){
        return DB::select('select p.*, c.category_name,v.name AS vendor_name from product2 AS p, categories AS c,vendors AS v where p.category_id = c.id and p.vendor_id=v.id ');
    }
}
