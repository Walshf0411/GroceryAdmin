<?php

namespace App\Service;

use App\Model\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class SubCategoryService{

    public function list_product_by_subcategory($subcategory_id){

        $count= DB::select('select * FROM product2 where subcategory_id=?',[$subcategory_id]);
        if(count($count)==0){
            return "Product with this subcategory does not exits";
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

public function insertSubCategory(Request $request){
    $cat = DB::select("select subcategory_name from subcategories where subcategory_name=?",[$request->subcategory_name]);
    // dd($cat);
    if (count($cat)==0){
        $subcategory = new SubCategory;
        // dd($request->file('category_image'));
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_image = "";
        $subcategory->save();
        if($request->hasFile('subcategory_image')){
            $path =storage_path("app/public/images/SubCategory/");
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $image = $request->file('subcategory_image');
            $extension = $image->extension();
            $name =  $subcategory->id.".".$extension;
            Image::make($image)->resize(100, 100)->save($path.$name);
            if(!File::isFile($path.$name)){
                return redirect()->back();
            }

            $subcategory = SubCategory::findOrFail($subcategory->id);
            $subcategory->subcategory_image = $name;
            $subcategory->save();
            return "success";
        }
    }else{
        return "error";
    }

    }
    public function listSubCategory(){
        return SubCategory::all();
    }
    public function deleteSubCategory($id){
        $subcategory = DB::select('select * from subcategories where id = ? limit 1', [$id]);
        if($subcategory==null){
            return redirect()->back()->with("error","Data Not Found ");
        }
        $image_path = storage_path('app/public/images/SubCategory/'.$subcategory[0]->subcategory_image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $subcategory = DB::delete('delete from subcategories where id = ?', [$id]);


    }
    public function editSubCategory($id){
        $subcategory = DB::select('select * from subcategories where id = ?', [$id]);
        if($subcategory==[]){
            return redirect()->back()->with("error","Data Not Found ");
        }
        return $subcategory;
    }

    public function updateSubCategory(Request $request, $id){
        $subcategory = DB::select('select * from subcategories where id = ?', [$id]);
        if($subcategory==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        $image_path = storage_path('app/public/images/SubCategory/'.$subcategory[0]->subcategory_image);
        if ($request->hasFile('subcategory_image')) {
            File::delete($image_path);
            $image = $request->file('subcategory_image');
            $extension = $image->extension();
            $name =  $id.".".$extension;
            Image::make($image)->resize(100, 100)->save(storage_path('app/public/images/SubCategory/').$name);

            $subcategory = DB::update('update subcategories set category_id = ?, subcategory_image = ?, subcategory_name = ? where id = ?', [$request->category_id, $name, $request->subcategory_name ,$id]);
        }else{
            $subcategory = DB::update('update subcategories set category_id = ?, subcategory_name = ? where id = ?', [$request->category_id,  $request->subcategory_name ,$id]);
        }

    }

    public function searchSubcategories($searchTerm){

        return SubCategory::where("subcategory_name", "like", "%${searchTerm}%")
                        ->orderBy("subcategory_name", "asc") 
                        ->get();
    }

}
