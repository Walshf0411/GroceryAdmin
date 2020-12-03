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

        // $products['products'] = DB::select("select * FROM ( `business` AS b ) INNER JOIN `products` AS p ON b.product_id = p.id INNER JOIN `vendors` AS v ON b.vendor_id = v.id GROUP BY b.product_id");
        $product['products'] = DB::select("select b.product_id,p.name FROM `business` AS b,products AS p where b.product_id=p.id group by product_id");
        $vendor['vendors'] = DB::select("select b.product_id,v.shop_name FROM `business` AS b,`products` AS p ,`vendors` AS v where b.product_id=p.id and b.vendor_id=v.id");
        // $products['products'] = DB::select("SELECT b.product_id,p.name,v.shop_name FROM `business` AS b,`products` AS p ,vendors AS v where b.product_id=p.id and b.vendor_id=v.id");
        $products=['$product'[$vendor['vendors']]];
        return response()->json($product);
        // $banner = Banner::all();
        // return view('Banner.list_banner', ['banners'=>$products]);

    }
}
