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

        $count= DB::select('select * FROM product2 where category_id=?',[$category_id]);
        if(count($count)==0){
            return "Product with this category does not exits";
        }else{
            $answer = array();
            foreach ($count as $product){
                $vendors = DB::select('select * from  vendors  where id= ?', [$product->vendor_id])['0'];
                    $product->vendor = $vendors;
                    array_push($answer, $product);
                }
            return $answer;
        }

    }

public function insertCategory(Request $request){
    $cat = DB::select("select category_name from categories where category_name=?",[$request->category_name]);
    // dd($cat);
    if (count($cat)==0){
        $category = new Category;
        // dd($request->file('category_image'));
        $category->category_name = $request->category_name;
        $category->category_image = "";
        $category->save();
        if($request->hasFile('category_image')){
            $path =storage_path("app/public/images/Category/");
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $image = $request->file('category_image');
            $extension = $image->extension();
            $name =  $category->id.".".$extension;
            Image::make($image)->resize(100, 100)->save($path.$name);
            if(!File::isFile($path.$name)){
                return redirect()->back();
            }

            $category = Category::findOrFail($category->id);
            $category->category_image = $name;
            $category->save();
            return "success";
        }
    }else{
        return "error";
    }

    }
    public function listCategory(){
        return Category::all();
    }
    public function deleteCategory($id){
        $category = DB::select('select * from categories where id = ? limit 1', [$id]);
        if($category==null){
            return redirect()->back()->with("error","Data Not Found ");
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
            return redirect()->back()->with("error","Data Not Found ");
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
