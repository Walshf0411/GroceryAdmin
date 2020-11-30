<?php

namespace App\Service;

use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
// use DB as DB;
use Illuminate\Support\Facades\DB;

class ProductService{
    public function viewAddProduct(){
        $category = Category::all();
        // dd($category['0']->id);
        return view('Product.add_product', ["category"=> $category]);
    }
    public function addProduct(Request $request){
        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        // return view('Product.add_product');

    }
    public function listProduct(){
        $products = DB::select('select p.*, c.category_name from products AS p, categories AS c where p.category_id = c.id ');
        return view('Product.list_product', ["products"=> $products]);
    }
    public function storeProduct(Request $request){
        $count = DB::select("select id from products order by id DESC LIMIT 1");
        if(count($count)==0){
            $number = 1;
        }else{
            $number = $count['0']->id +1;
        }


        $images=array();
        $counter = 0;
        if($files=$request->file('images')){
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
        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->images =implode("|",$images) ;
        $product->save();

        return redirect()->route("list_product")->with("message","data inserted successfully");
    }

    public function deleteProduct($id){
        File::deleteDirectory(storage_path("app/public/images/Product/$id"));
        $product = Product::findOrFail($id)->delete();

        return redirect()->back()->with("message","data deleted successfully");
    }

    public function editProduct($id){
        $product = DB::select('select p.*, c.category_name from products AS p, categories as c where p.id = ? and p.category_id = c.id', [$id]);
        $category = Category::all();
        if($product==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        return view('Product.edit_product', ['product'=> $product, 'category'=> $category]);
    }
    public function updateProject(Request $request, $id){
        $product = DB::select('select p.*, c.category_name from products AS p, categories as c where p.id = ? and p.category_id = c.id', [$id]);
        if($product==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        if($files=$request->file('images')){
            File::deleteDirectory(storage_path("app/public/images/Product/$id"));
            $images=array();
            $counter = 0;

            foreach($files as $file){
                $counter += 1;
                // $name=$file->getClientOriginalName();
                $extension = $file->extension();
                $name =  $counter.".".$extension;
                $path = storage_path("app/public/images/Product/$id/");
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                Image::make($file)->resize(100, 100)->save($path.$name);
                $file->move('image',$name);
                $images[]=$name;
            }
            DB::update("update products AS p set p.name= ?, p.category_id = ?, p.images= ? where id=? ",[$request->name, $request->category_id, implode("|",$images), $id]);
        }else{
            DB::update("update products AS p set p.name= ?, p.category_id = ? where id=? ",[$request->name, $request->category_id, $id]);
        }
        return redirect()->route('list_product')->with("Success","Data Edited Successfully");
    }
}

?>
