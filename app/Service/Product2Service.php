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
use Illuminate\Support\Facades\Log;

class Product2Service{
    public function getAllVendorProducts($id){
        return DB::select('select * from product2 where vendor_id = ? order by id DESC ', [$id]);
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
            $getSubCategory = DB::select('select * from subcategories where id = ?', [$items->subcategory_id])['0'];
            $getCategory = DB::select('select * from categories where id = ?', [$items->category_id])['0'];
            $items->vendor = $getVendor;
            $items->subcategory = $getSubCategory;
            $items->category = $getCategory;
            array_push($newProd, $items);
        }
        return $newProd;

    }

    public function searchProducts($searchTerm){

        $products = Product2::where("name", "like", "%${searchTerm}%")
                        ->orderBy("name", "asc") 
                        ->get();

        foreach ($products as $product) {
            $product->vendor = $product->vendor;
        }

        return $products;
    }

    public function listProduct(){
        $products = DB::select('select * from product2 order by id DESC ');
        $newProd = array();
        foreach ($products as $items) {
            $getVendor = DB::select('select * from vendors where id = ?', [$items->vendor_id])['0'];
            $getCategory = DB::select('select * from categories where id = ?', [$items->category_id])['0'];
            $getSubCategory = DB::select('select * from subcategories where id = ?', [$items->subcategory_id])['0'];
            $items->vendor = $getVendor;
            $items->category = $getCategory;
            $items->subcategory = $getSubCategory;
            array_push($newProd, $items);
        }
        return $newProd;
        // dd($newProd);

    }
    public function getProductDetails($id){
        $productdescription = DB::select('select * from product2 where id=?',[$id]);
        return $productdescription;
    }

    // public function insertProduct(Request $request){

    //     $product = new Product2;
    //     $product->name = $request->name;
    //     $product->vendor_id = $request->vendor_id;
    //     $product->category_id = $request->category_id;
    //     $product->unit = $request->unit;
    //     $product->discount = $request ->discount;
    //     $product->price = $request -> price;
    //     $product->description = $request -> description;
    //     $product->images =  "yet to be added";

    //     $product->save();

    //     $images=array();
    //     $counter = 0;
    //     if($files=$request->file('images')){
    //         foreach($files as $file){
    //             $counter += 1;
    //             // $name=$file->getClientOriginalName();
    //             $extension = $file->extension();
    //             $name =  $counter.".".$extension;
    //             $path = storage_path("app/public/images/Product/$product->id/");
    //             if(!File::isDirectory($path)){
    //                 File::makeDirectory($path, 0777, true, true);
    //             }
    //             Image::make($file)->resize(100, 100)->save($path.$name);
    //             $file->move('image',$name);
    //             $images[]=$name;
    //         }
    //     }
    //     $updateTempProd = DB::table('product2')
    //     ->where('id', $product->id)
    //    ->update(['images' =>implode("|",$images)]);

    //     return "Product Inserted Successfully";
    // }
    public function getProduct($id){
        return Product2::findOrFail($id);
        // dd( Product2::findOrFail($id));
    }
    public function editProduct(Request $request,$id){
        $temp = Product2::findOrFail($id);
        $temp->name = $request->name;
        $temp->vendor_id= $request->vendor_id;
        $temp->category_id = $request->category_id;
        $temp->subcategory_id = $request->subcategory_id;
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

    public function editProductByVendor(Request $request, $id){
        if(DB::select("select * from product2 where id= ? ",[$id])==[]){
            return "Sorry no product as such was found";
        }
        $temp = Product2::findOrFail($id);
        $temp->unit = $request->unit;
        $temp->price = $request->price;
        $temp->discount = $request->discount;
        $temp->save();
        return "Prodcut Edited Successfully";
    }

    public function productExistsCheck($id, $name){
        // $details = (object)[];
        // //'like','%' . . '%'
        // $details->products = 
        return Product2::where('vendor_id', $id)->where('name',  $name['name'] )->get();
    }

}
