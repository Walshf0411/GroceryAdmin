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
        $temp->subcategory_id = $request->subcategory_id;
        $temp->unit = $request->unit;
        $temp->description = $request->description;
        $temp->price = $request->price;
        $temp->images = "yet to be uploaded";

        $temp->discount = $request->discount;

        $temp->save();
        $counter = 0;
        $images=array();
        if ($request->image != null) {
            $file = base64_decode($request->image);
            $safeName = "1.png";
            $path = storage_path("app/public/images/TempProduct/$temp->id/");
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            $success = File::put($path.$safeName, $file);
            if(!$success){
                return "error";
            }
            $image = $safeName;

            $updateTempProd = DB::table('tempprod2')
            ->where('id', $temp->id)
            ->update(['images' => $image]);
        } else {
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
            $updateTempProd = DB::table('tempprod2')
            ->where('id', $temp->id)
           ->update(['images' =>implode("|",$images)]);
        }


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
        $temp->category_id = $request->category_id;
        $temp->subcategory_id = $request->subcategory_id;
        $temp->unit = $request->unit;
        $temp->description = $request->description;
        $temp->price = $request->price;
        $temp->discount = $request->discount;

        $counter = 0;
        $name = "";
        if($request->image != null){
            $path = storage_path("app/public/images/TempProduct/$id/");
            if(File::isDirectory($path)){
                File::deleteDirectory($path);
            }
            $file = base64_decode($request->image);
            $safeName = "1.png";
            $path = storage_path("app/public/images/TempProduct/$temp->id/");
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            $success = File::put($path.$safeName, $file);
            if(!$success){
                return "error";
            }
            $image = $safeName;

            $updateTempProd = DB::table('tempprod2')
            ->where('id', $temp->id)
            ->update(['images' => $image]);

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
        $prod->subcategory_id = $tempProd['0']->subcategory_id;
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
        return DB::select('select t.* ,c.category_name ,v.shop_name, s.subcategory_name 
        from tempprod2 AS t, categories AS c ,vendors AS v, subcategories AS s 
        where t.category_id = c.id and t.vendor_id = v.id and t.subcategory_id = s.id');
    }

    public function listVendorTempProducts($id){
        return DB::select('select t.* from tempprod2 t where vendor_id= ? order by id DESC', [$id]);
    }
}
