<?php

namespace App\Api;
// namespace App\Http\Controllers;
use App\Model\Banner;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiService
{

    public function getHomePage(){
        return response()->json(["banners"=>$this->getAllBanner(), "categories"=>$this->getAllCategory(), "products_list"=>$this->getAllProducts()]);
    }

    public function getAllCategory(){
        return Category::all('id','category_name', 'category_image');
    }

    public function getAllBanner(){
        return Banner::all("id","banner_image");
    }
    public function getAllProducts(){
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
