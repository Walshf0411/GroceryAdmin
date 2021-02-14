<?php

namespace App\Service;

use App\Model\TempProduct2;
use App\Model\Product2;
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

    public function homeListProduct(){
        return Product2::all();
        return DB::select('select * from product2 LIMIT 10');

    }

    public function storeProduct(Request $request){
        $count = DB::select("select id from product2 order by id DESC LIMIT 1");
        if(count($count)==0){
            $number = 1;
        }else{
            $number = $count['0']->id +1;
        }
        $images=array();
        $counter = 0;
        if($files=$request->file('images')){
            foreach($files as $file){
                $counter += 1;
                // $name=$file->getClientOriginalName();
                $extension = $file->extension();
                $name =  $counter.".".$extension;
                $path = storage_path("app/public/images/Product/$number/");
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                Image::make($file)->resize(100, 100)->save($path.$name);
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        $product = new Product2;
        $product->name = $request->name;
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->unit = $request->unit;
        $product->discount = $request ->discount;
        $product->price = $request -> price;
        $product->description = $request -> description;
        $product->images =implode("|",$images) ;
        $product->save();


    }
}
