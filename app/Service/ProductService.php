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
        return Category::all();
    }

    public function listProduct(){
        return DB::select('select p.*, c.category_name from products AS p, categories AS c where p.category_id = c.id ');

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


    }

    public function deleteProduct($id){
        File::deleteDirectory(storage_path("app/public/images/Product/$id"));
        $product = Product::findOrFail($id)->delete();


    }

    public function editProduct($id){
        $product = DB::select('select p.*, c.category_name from products AS p, categories as c where p.id = ? and p.category_id = c.id', [$id]);
        $category = Category::all();
        if($product==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        return [$product, $category];
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
    }
    public function productsWithDetials(){
        $proarray=DB::select("select distinct b.product_id, p.name from business as b , `products` AS p where b.product_id = p.id");
        $products=array();
        $count = 0;
        foreach($proarray as $item){
        array_push($products,array("id"=>$proarray[(String)$count]->product_id, "product_name" =>$proarray[(String)$count]->name, "vendors" => DB::select("select b.price, b.images, v.name, b.description FROM products AS p, business AS b, vendors as v WHERE b.product_id = p.id and b.vendor_id= v.id and p.id = ?",[$item->product_id]) ));
        $count += 1;
       }
        return $products;
    }
}

?>
