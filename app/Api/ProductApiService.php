<?php

namespace App\Api;
// namespace App\Http\Controllers;
use App\Model\TempProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
// new \Intervention\Image\ImageManager;

class ProductApiService
{
    public function test(Request $request){
        $counter = 0;
        // var_dump($request);
        if($files=$request->images){
            foreach($files as $file){
                $counter += 1;
                // $name=$file->getClientOriginalName();
                $extension = $file->extension();
                $name =  $counter.".".$extension;
                $path = storage_path("app/public/images/Demo/");
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                Image::make($file)->resize(100, 100)->save($path.$name);
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        return response()->json(["message"=>$request->images]);
    }
    public function create_temp_product(Request $request)
    {
        //checking whether the product exists or not
        $count = DB::select("select c.id,p.id from temp_products as c, products as p where p.name = ? or c.name = ? ", [$request->name, $request->name]);
        if(count($count)>0){
            return response()->json(["message"=> "Product already exists"]);
        }
        //inserting record with no image
        $temp = new TempProduct();
        $temp->name = $request->name;
        $temp->vendor_id= $request->vendor_id;
        $temp->category_id = $request->category_id;
        $temp->images = "yet to be uploaded";
        $temp->save();

        //collecting id inorder to create folder of that with name of that id
        $getid = DB::select("select id from temp_products order  by id  DESC limit 1");
        $number = $getid['0']->id;
        //storing images in the folder with name $number(id)
        $images=array();
        $counter = 0;
        if($files=$request->file('images')){
            foreach($files as $file){
                $counter += 1;
                // $name=$file->getClientOriginalName();
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
        //updating the image names
        $adding = TempProduct::find($number)->update(['images'=>implode("|",$images)]);
        // $adding->save();
        return response()->json(["message"=>$request->file('images')]);
    }


}
