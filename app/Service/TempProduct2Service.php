<?php

namespace App\Service;

use App\Model\TempProduct2;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use App\Model\Product2;

class TempProduct2Service{
    public function addTempProduct(Request $request){
        $temp = new TempProduct2();
        $temp->name = $request->name;
        $temp->vendor_id= $request->vendor_id;
        $temp->category_id = $request->category_id;
        $temp->unit = $request->unit;
        $temp->description = $request->description;
        $temp->price = $request->price;
        $temp->images = "yet to be uploaded";

        $temp->discount = $request->discount;

        $temp->save();
        $counter = 0;
        $images=array();
        foreach($request->images as $imstr){
            $file = base64_decode($imstr);
            $counter += 1;
            $safeName = $counter.'.'.'png';
            $path = storage_path("app/public/images/TempProduct/$temp->id/");
            $success = file_put_contents($path.$safeName, $file);
            if(!$success){
                return "error";
            }
            $images[]=$safeName;
        }
        //storing images in the folder with name $number(id)
        // $images=array();
        // $counter = 0;
        // if($files=$request->file('images')){
        //     foreach($files as $file){
        //         $counter += 1;
        //         $extension = $file->extension();
        //         $name =  $counter.".".$extension;
        //         $path = storage_path("app/public/images/TempProduct/$temp->id/");
        //         if(!File::isDirectory($path)){
        //             File::makeDirectory($path, 0777, true, true);
        //         }
        //         Image::make($file)->resize(100, 100)->save($path.$name);
        //         $file->move('image',$name);
        //         $images[]=$name;
        //     }
        // }

        $updateTempProd = DB::table('tempprod2')
        ->where('id', $temp->id)
       ->update(['images' =>implode("|",$images)]);


        return "Temp Product inserted successfully";
    }

    public function deleteTempProduct($id){
        if(!File::isDirectory(storage_path("app/public/images/TempProduct/$id"))){
            File::deleteDirectory(storage_path("app/public/images/TempProduct/$id"));
        }
        $tempproducts = TempProduct2::findOrFail($id)->delete();

        return "Product Deleted Successfully";
    }

    public function editTempProdcut($id, Request $request){
        $temp = TempProduct2::findOrFail($id);
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
            $path = storage_path("app/public/images/TempProduct/$id/");
            if(File::isDirectory($path)){
                File::deleteDirectory($path);
            }
            foreach($files as $file){
                $counter += 1;
                $extension = $file->extension();
                $name =  $counter.".".$extension;
                $path = storage_path("app/public/images/TempProduct/$id/");
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

    public function approveTempProduct($id){
        $tempProd = DB::select('select * from tempprod2 where id = ?', [$id]);
        if($tempProd==[]){
            return "tempProduct does not exists";
        }
        $prod = new Product2;
        $prod->vendor_id= $tempProd['0']->vendor_id;
        $prod->category_id = $tempProd['0']->category_id;
        $prod->name = $tempProd['0']->name;
        $prod->description = $tempProd['0']->description;
        $prod->price = $tempProd['0']->price;
        $prod->unit = $tempProd['0']->unit;
        $prod->discount = $tempProd['0']->discount;
        $prod->images = $tempProd['0']->images;
        $prod->save();

        $path = storage_path("app/public/images/TempProduct/$id/");
        $newpath = storage_path("app/public/images/Product/$prod->id/");
        $path1 = storage_path("app/public/images/Product/");

        if(!File::isDirectory($path1)){
            File::makeDirectory($path1, 0777, true, true);
        }
        if(File::isDirectory($path)){
            if(File::isDirectory($newpath)){
                File::makeDirectory($newpath, 0777, true, true);
            }
            File::move($path, $newpath);
            File::deleteDirectory($path);
        }
        return "Product approved successfully";
    }

    public function rejectedTempProduct($id){
        // $message = $request->message;
        DB::delete('delete from tempprod2 where id = ?', [$id]);
        $path = storage_path("app/public/images/TempProduct/$id/");
        if(File::isDirectory($path)){
            File::deleteDirectory($path);
        }
        // return "Product rejected Successfully";
    }

    public function listTempProduct(){
        return DB::select('select t.* ,c.category_name ,v.shop_name from tempprod2 AS t, categories AS c ,vendors AS v where t.category_id = c.id and t.vendor_id = v.id');
    }

    public function listVendorTempProducts($id){
        return DB::select('select t.* from tempprod2 t where vendor_id= ? order by id DESC', [$id]);
    }
}
