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
        return DB::select('select p.*, c.category_name from product2 AS p, categories AS c where p.category_id = c.id ');

    }
    public function storeProduct(Request $request){
        $count = DB::select("select id from product2 order by id DESC LIMIT 1");
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
        $product->unit = $request->unit;
        $product->images =implode("|",$images) ;
        $product->save();


    }

    public function delete_product($id){
        if(File::isDirectory(storage_path("app/public/images/Product/$id"))){
            File::deleteDirectory(storage_path("app/public/images/Product/$id"));
        }

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
            DB::update("update products AS p set p.name= ?, p.category_id = ?, p.images= ?,p.unit=? where id=? ",[$request->name, $request->category_id, implode("|",$images),$request->unit, $id]);
        }else{
            DB::update("update products AS p set p.name= ?, p.category_id = ? ,p.unit=?  where id=? ",[$request->name, $request->category_id,$request->unit, $id]);
        }
    }
    public function productsWithDetials(){
        $proarray=DB::select("select distinct b.product_id, p.name from business as b , `product2` AS p where b.product_id = p.id");
        $products=array();
        $count = 0;
        foreach($proarray as $item){
        array_push($products,array("id"=>$proarray[(String)$count]->product_id, "product_name" =>$proarray[(String)$count]->name, "vendors" => DB::select("select b.price, b.images, v.name, b.description FROM products AS p, business AS b, vendors as v WHERE b.product_id = p.id and b.vendor_id= v.id and p.id = ?",[$item->product_id]) ));
        $count += 1;
       }

        return $products;
    }

    public function viewSelectedProducts($vendor_id){
        return DB::select('select p.* from products p where p.id NOT IN (SELECT b.product_id from business b where b.vendor_id=?)', [$vendor_id]);
    }
}

?>
