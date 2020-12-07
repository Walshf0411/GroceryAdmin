<?php

namespace App\Api;
// namespace App\Http\Controllers;
use App\Model\Business;
use App\Model\TempProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BusinessApiService
{
    public function insertBusiness(Request $request){
    //     $validator = Validator::make($request->all(),
    //     [
    //     'images' =>  'required|mimes:png,jpg|max:2048',
    //    ]);
    $count = DB::select("select * FROM `business` As b,`products` AS p WHERE b.product_id=p.id and b.product_id=?",[$request->product_id]);

            if(count($count)>0){

            $count = DB::select("select id from business order by id DESC LIMIT 1");
                if(count($count)==0){
                    $number = 1;
                }else{
                    $number = $count['0']->id +1;
                }

                $images=array();
                $counter = 0;
                $business = new Business;
                if($files=$request->file('images')){
                    foreach($files as $file){
                        $counter += 1;
                        // $name=$file->getClientOriginalName();
                        $extension = $file->extension();
                        $name =  $counter.".".$extension;
                        $path = storage_path("app/public/images/Business/$number/");
                        if(!File::isDirectory($path)){
                            File::makeDirectory($path, 0777, true, true);
                        }
                        Image::make($file)->resize(100, 100)->save($path.$name);
                        $file->move('image',$name);
                        $images[]=$name;

                        // $business->images = $name;
                    }

                }

                $business = new Business;
                $business->product_id = $request->product_id;
                $business->category_id = $request->category_id;
                $business->vendor_id = $request->vendor_id;
                $business->price = $request->price;
                $business->description = $request->description;
                $business->stocks = $request->stocks;
                $business->discount = $request->discount;
                // $business->images = json_encode($images);
                $business->images = implode("|",$images);
                $business->save();

                return response()->json(["message" => "Data inserted Successfully"]);
            }
            else
            {
                $tempproducts = DB::insert('insert into `temp_products` (`vendor_id`, `category_id`,
                 `name`, `images`)
                 VALUES (?,?,?,?);',[$request->vendor_id,$request->category_id,]);
                 $count = DB::select("select id from temp_products order by id DESC LIMIT 1");
                        if(count($count)==0){
                            $number = 1;
                        }else{
                            $number = $count['0']->id +1;
                        }

                        $images=array();
                        $counter = 0;
                        $business = new TempProduct;
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

                                // $business->images = $name;
                            }

                        }
                return redirect()->action([TempProductController::class, 'store']);
            }
        }


        public function deleteBusiness($id){
        File::deleteDirectory(storage_path("app/public/images/Business/$id"));
        $business = Business::findOrFail($id)->delete();
        return response()->json(["message" => "Data deleted Successfully"]);
        }



        public function updateBusiness(Request $request, $id){
            $business = DB::select('select * from business where id = ?', [$id]);
            if($business==[]){
                return response()->json(["message" => "Data Not Found"]);
            }

            // if($files=$request->file('images')){
            //     File::deleteDirectory(storage_path("app/public/images/Business/$id"));
            //     $images=array();
            //     $counter = 0;

            //     foreach($files as $file){
            //         $counter += 1;
            //         // $name=$file->getClientOriginalName();
            //         $extension = $file->extension();
            //         $name =  $counter.".".$extension;
            //         $path = storage_path("app/public/images/Business/$id/");
            //         if(!File::isDirectory($path)){
            //             File::makeDirectory($path, 0777, true, true);
            //         }
            //         Image::make($file)->resize(100, 100)->save($path.$name);
            //         $file->move('image',$name);
            //         $images[]=$name;
            //     }
            //     DB::update("update business set price= ?,description=?,product_id=?,
            //      vendor_id=?, category_id = ?, images= ?,stocks = ?,discount =? where id=? ",
            //      [$request->price,$request->description, $request->product_id, $request->vendor_id,
            //       $request->category_id, implode("|",$images),$request->stocks,$request->discount,  $id]);
            // }else{
            //     DB::update("update business set price= ?,description=?,product_id=?,
            //     vendor_id=?, category_id = ? ,stocks = ?,discount =? where id=? ",
            //     [$request->price,$request->description, $request->product_id, $request->vendor_id,
            //      $request->category_id,$request->stocks,$request->discount, $id]);
            // }
            // return response()->json(["message" => "Data updated Successfully"]);
            $image_path = storage_path('app/public/images/Business/'.$business[0]->images);
            if (File::exists($image_path)) {
                File::delete($image_path);
                $image = $request->file('images');
                $extension = $image->extension();
                $name =  $id.".".$extension;
                Image::make($image)->resize(100, 100)->save(storage_path('app/public/images/Business/').$name);

                $business = DB::update('update business set images = ? where id = ?', [$name, $id]);
            }
            return response()->json(["message" => "Data updated Successfully"]);
        }

}
