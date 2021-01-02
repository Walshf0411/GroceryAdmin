<?php

namespace App\Service;

use App\Model\TempProduct;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class TempProductService{

    public function listProduct(){
        return DB::select('select t.* ,c.category_name ,v.shop_name from temp_products AS t, categories AS c ,vendors AS v where t.category_id = c.id and t.vendor_id = v.id');
    }

    public function addProduct($id){
        $tempproducts = DB::insert('insert into products (category_id, name,images,unit)
                                    SELECT category_id, name,images,unit FROM temp_products where id=?',[$id]);
        $count = DB::select("select id from products order by id DESC LIMIT 1");
            if(count($count)==0){
                    $number = 1;
            }else{
                    $number = $count['0']->id +1;
            }
            $path = storage_path("app/public/images/Product/$number/");
            $path1 = storage_path("app/public/images/TempProduct/$id/");
            File::move($path1, $path);

    }


    public function deleteProduct($id){
        File::deleteDirectory(storage_path("app/public/images/TempProduct/$id"));
        $tempproducts = TempProduct::findOrFail($id)->delete();

    }
}
