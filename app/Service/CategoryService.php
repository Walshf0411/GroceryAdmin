<?php

namespace App\Service;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
// use DB as DB;
use Illuminate\Support\Facades\DB;
class CategoryService{

    public function list_product_by_category($category_id){

        $count= DB::select('select * FROM `categories` where id=?',[$category_id]);
        if(count($count)==0){
            return "category doesnt exits";
        }else{
            $answer = array();
            $products = DB::select('select p.* FROM `products` AS p WHERE p.category_id = ? ',[$category_id]);
            foreach ($products as $product){
                $vendors = DB::select('select b.*, v.* from business b, vendors v, products p where p.id = b.product_id and v.id=b.vendor_id and b.category_id=? and b.product_id = ? ORDER BY b.price ASC', [$category_id, $product->id]);
                // dd($products);
                if($vendors !=[]){
                    $product->vendors = $vendors;
                    array_push($answer, $product);
                }
                
                // $product->merge([
                //     'vendors' => $vendors
                // ]);
                
                }
                dd($answer);
        }

    }

public function insertCategory(Request $request){
    $count = DB::select("select id from categories order by id DESC LIMIT 1");
        if(count($count)==0){
            $number = 1;
        }else{
            $number = $count['0']->id +1;
        }
        if($request->hasFile('category_image')){

            $path =storage_path("app/public/images/Banner/");
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $image = $request->file('category_image');
            $extension = $image->extension();
            $name =  $number.".".$extension;
            Image::make($image)->resize(100, 100)->save(storage_path('app/public/images/Category/').$name);
            $category = new Category;
            $category->category_name = $request->category_name;
            $category->category_image = $name;
            $category->save();
        }

    }
    public function listCategory(){
        return Category::all();
    }
    public function deleteCategory($id){
        $category = DB::select('select * from categories where id = ? limit 1', [$id]);
        if($category==null){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        $image_path = storage_path('app/public/images/Category/'.$category[0]->category_image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $category = DB::delete('delete from categories where id = ?', [$id]);


    }
    public function editCategory($id){
        $category = DB::select('select * from categories where id = ?', [$id]);
        if($category==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        return $category;
    }

    public function updateCategory(Request $request, $id){
        $category = DB::select('select * from categories where id = ?', [$id]);
        if($category==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        $image_path = storage_path('app/public/images/Category/'.$category[0]->category_image);
        if ($request->hasFile('category_image')) {
            File::delete($image_path);
            $image = $request->file('category_image');
            $extension = $image->extension();
            $name =  $id.".".$extension;
            Image::make($image)->resize(100, 100)->save(storage_path('app/public/images/Category/').$name);

            $category = DB::update('update categories set category_image = ?, category_name = ? where id = ?', [$name, $request->category_name ,$id]);
        }else{
            $category = DB::update('update categories set category_name = ? where id = ?', [ $request->category_name ,$id]);
        }

    }

}
