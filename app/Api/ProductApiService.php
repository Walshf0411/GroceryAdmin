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
    public function create_temp_product(Request $request)
    {

         $count = DB::select("select id from temp_products order by id DESC LIMIT 1");
            if(count($count)==0){
                $number = 1;
            }else{
                $number = $count['0']->id +1;
            }
        // if ($request->hasFile('images')) {
        //     if($request->file('images')) {

        //             $file = $request->file('images');
        //             $image = base64_encode(file_get_contents($file));
        //             echo $image;


        //     }
        // }

        $counter = 0;
        // $image = base64_encode(file_get_contents($request->file('images')));
        if($files = $request->('images')) ){
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
        $product = new TempProduct;
        $product->name = $request->name;
        $product->vendor_id= $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->images = implode("|",$images);
        $product->save();

                return response()->json($images);
    }


}
