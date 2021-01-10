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
                                    SELECT category_id,temp_product_name,images,unit FROM temp_products where id=?',[$id]);
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


    public function temp_delete_product($id){
        if(!File::isDirectory(storage_path("app/public/images/TempProduct/$id"))){
            File::deleteDirectory(storage_path("app/public/images/TempProduct/$id"));
        }
        $tempproducts = TempProduct::findOrFail($id)->delete();

    }
    public function create_temp_product(Request $request)
    {
        //checking whether the product exists or not
        $count = DB::select("select c.id,p.id from temp_products as c, products as p where p.name = ? or c.temp_product_name = ? ", [$request->name, $request->temp_product_name]);
        if(count($count)>0){
            return response()->json(["message"=> "Product already exists"]);
        }
        //inserting record with no image
        $temp = new TempProduct();
        $temp->temp_product_name = $request->temp_product_name;
        $temp->vendor_id= $request->vendor_id;
        $temp->category_id = $request->category_id;
        $temp->unit = $request->unit;
        $temp->images = "yet to be uploaded";
        $temp->save();

        //collecting id inorder to create folder of that with name of that id
        $getid = DB::select("select id from temp_products order  by id  DESC limit 1");
        if (count($getid) == 0) {
            $number = 1;
        } else {
            $number = $count['0']->id + 1;
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

        $temp = new TempProduct();
        $temp->temp_product_name = $request->name;
        $temp->vendor_id= $request->vendor_id;
        $temp->category_id = $request->category_id;
        $temp->unit = $request->unit;
        $temp->images = $images;
        $temp->save();

        return response()->json(["message"=>"Temp Product inserted successfully"]);
    }
    public function test(Request $request){
        $counter = 0;

        if($request->hasFile('images')){
            $files = $request->file('images');

            foreach($files as $file){
                $counter += 1;

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
        return response()->json(["message"=>$request->file('images')]);

    }
}
