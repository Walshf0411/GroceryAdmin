<?php

namespace App\Service;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
// use DB as DB;
use Illuminate\Support\Facades\DB;
class CategoryService{


public function insertCategory(Request $request){
    $count = DB::select("select id from categories order by id DESC LIMIT 1");
        if(count($count)==0){
            $number = 1;
        }else{
            $number = $count['0']->id +1;
        }
        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $extension = $image->extension();
            $name =  $number.".".$extension;
            Image::make($image)->resize(100, 100)->save(storage_path('app/public/images/Category/').$name);
            $category = new Category;
            $category->category_name = $request->category_name;
            $category->category_image = $name;
            $category->save();
        }
        return redirect()->back()->with("Success","Data inserted Successfully");
    }
    public function listCategory(){
        $category = Category::all();
        return view('Category.list_category', ['category'=>$category]);
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

        return redirect()->back()->with("Success","Data deleted Successfully");
    }
    public function editCategory($id){
        $category = DB::select('select * from categories where id = ?', [$id]);
        if($category==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        return view('Category.edit_category', ['category'=> $category]);
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
        return redirect()->route('list_category')->with("Success","Data deleted Successfully");;
    }

}
