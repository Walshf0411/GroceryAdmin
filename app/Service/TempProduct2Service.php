<?php

namespace App\Service;

use App\Model\TempProduct2;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class TempProduct2Service{
    public function addTempProduct(Request $request){
        $getid = DB::select("select id from tempprod2 order  by id  DESC limit 1");
        if (count($getid) == 0) {
            $number = 1;
        } else {
            // dd($getid);
            $number = $getid['0']->id + 1;
        }
        //storing images in the folder with name $number(id)
        $images=array();
        $counter = 0;
        if($files=$request->file('images')){
            foreach($files as $file){
                $counter += 1;
                $extension = $file->extension();
                $name =  $counter.".".$extension;
                $path = storage_path("app/public/images/TempProduct/$number/");
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                Image::make($file)->resize(100, 100)->save($path.$name);
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        //inserting data in db

        $temp = new TempProduct2();
        $temp->name = $request->name;
        $temp->vendor_id= $request->vendor_id;
        $temp->category_id = $request->category_id;
        $temp->unit = $request->unit;
        $temp->description = $request->description;
        $temp->price = $request->price;
        $temp->images = implode("|",$images);
        $temp->discount = $request->discount;

        $temp->save();

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
        $product = DB::insert('insert into product2(vendor_id, category_id, name, description, price, unit, images, discount, created_at, updated_at)
        select vendor_id, category_id, name, description, price, unit, images, discount, NOW(), NOW() from tempprod2 where id=?',[$id]);
        $path = storage_path("app/public/images/TempProduct/$id/");
        $latestId = DB::getPdo()->lastInsertId();
        $newPath = storage_path("app/public/images/Product/$latestId/");
        if(File::isDirectory($path)){
            if(File::isDirectory($newPath)){
                File::makeDirectory($newPath, 0777, true, true);
            }
            File::copy($path, $newPath);
        }
        return "Product approved successfully";
    }

    public function rejectedTempProdcut(Request $request, $id){
        $message = $request->message;
        DB::delete('delete from tempprod2 where id = ?', [$id]);
        $path = storage_path("app/public/images/TempProduct/$id/");
        if(File::isDirectory($path)){
            File::deleteDirectory($path);
        }
        return "Product rejected Successfully";
    }

    public function listTempProdcuts($id){
        return DB::select('select * from tempprod2 where vendor_id = ?', [$id]);
    }
}
