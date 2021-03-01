<?php

namespace App\Service;

use App\Model\TempProduct2;
use App\Model\Product2;
use App\Model\Category;
use App\Model\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class Product2Service{
    public function getAllVendorProducts($id){
        return DB::select('select * from product2 where vendor_id = ? ', [$id]);
    }


    public function viewAllCategories(){
        return Category::all();
    }

    public function viewAllVendors(){
        return Vendor::all();
    }
    public function homeListProduct(){
        $products = DB::select('select * from product2 LIMIT 10');
        $newProd = array();
        foreach ($products as $items) {
            $getVendor = DB::select('select * from vendors where id = ?', [$items->vendor_id])['0'];
            $getCategory = DB::select('select * from categories where id = ?', [$items->category_id])['0'];
            $items->vendor = $getVendor;
            $items->category = $getCategory;
            array_push($newProd, $items);
        }
        return $newProd;

    }

    public function listProduct(){
        $products = DB::select('select * from product2 ');
        $newProd = array();
        foreach ($products as $items) {
            $getVendor = DB::select('select * from vendors where id = ?', [$items->vendor_id])['0'];
            $getCategory = DB::select('select * from categories where id = ?', [$items->category_id])['0'];
            $items->vendor = $getVendor;
            $items->category = $getCategory;
            array_push($newProd, $items);
        }
        return $newProd;
        // dd($newProd);

    }

    public function insertProduct(Request $request){
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

        return "Product Inserted Successfully";
    }

    public function editProduct(Request $request,$id){
        $temp = Product2::findOrFail($id);
        $temp->name = $request->name;
        $temp->vendor_id= $request->vendor_id;
        $temp->category_id = $request->category_id;
        $temp->unit = $request->unit;
        $temp->description = $request->description;
        $temp->price = $request->price;
        $temp->discount = $request->discount;

        $images=array();
        $counter = 0;
        if($files=$request->file('images')){
            $path = storage_path("app/public/images/Product/$id/");
            if(File::isDirectory($path)){
                File::deleteDirectory($path);
            }
            foreach($files as $file){
                $counter += 1;
                $extension = $file->extension();
                $name =  $counter.".".$extension;
                $path = storage_path("app/public/images/Product/$id/");
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                Image::make($file)->resize(100, 100)->save($path.$name);
                $file->move('image',$name);
                $images[]=$name;
            }
            $temp->images = implode("|",$images);
        }

        $temp->save();
        return "Product Edited Successfully";
    }

    public function deleteProduct($id){
        if(!File::isDirectory(storage_path("app/public/images/Product/$id"))){
            File::deleteDirectory(storage_path("app/public/images/Product/$id"));
        }
        $products = Product2::findOrFail($id)->delete();

        return "Product Deleted Successfully";
    }


    public function getOrderByProduct($id){
        $orderproducts= DB::select("select p.*,v.name as vendor_name from product2 as p,vendors as v, orderdescription AS od where od.order_id = ? and od.product_id = p.id and od.vendor_id=v.id", [$id]);
        return $orderproducts;
      }
}
