<?php

namespace App\Api;
// namespace App\Http\Controllers;
use App\Model\Banner;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiService
{

    public function getAllBanner(){
        $banners['banners'] = Banner::all();
        $categories['category'] = Category::all();
        return response()->json(array_merge($banners, $categories));
    }


    public function getAllProducts(){

        // $products['products'] = DB::select("SELECT * FROM `products` AS p, business AS b, vendors as v WHERE b.product_id = p.id and b.vendor_id= v.id group by p.id");
        // $vendor['vendors'] = DB::select("select b.product_id,p.name,v.shop_name FROM `business` AS b,`products` AS p ,`vendors` AS v where b.product_id=p.id and b.vendor_id=v.id");
        // $product['products'] = DB::select("select b.product_id,p.name FROM `business` AS b,products AS p where b.product_id=p.id group by product_id");

        // $products['products'] = DB::select("select  * from business AS b ,(select distinct product_id from business) AS p where p.product_id = b.product_id");
        // select distinct product_id from business -> execute this query
        // loop the output array
        // now apply query seelct * from business where product_id = array[i]

        $proarray=array();
        $proarray=DB::select("select distinct b.product_id, p.name from business as b , `products` AS p where b.product_id = p.id");
        $products=array();
        $count =0;
        foreach($proarray as $item){
        //    dd($item->product_id);
        $count += 1;

        array_push($proarray->$count,DB::select("select * FROM products AS p, business AS b, vendors as v WHERE b.product_id = p.id and b.vendor_id= v.id and p.id = ?",[$item->product_id]));
        // $products = DB::select("select * FROM products AS p, business AS b, vendors as v WHERE b.product_id = ? and b.vendor_id= v.id",[$item->product_id]);
       }
        // $products=[$vendor,$product];
        return response()->json(["products"=>$proarray]);
        // return null;
        // $banner = Banner::all();
        // return view('Banner.list_banner', ['banners'=>$products]);

    }
}
