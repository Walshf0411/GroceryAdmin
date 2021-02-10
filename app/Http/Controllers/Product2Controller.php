<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\Product2Service;

class Product2Controller extends Controller
{
    //

    public function __construct(Product2Service $service){
        $this->service = $service;
        // $this->middleware('auth');
    }

    public function show(){
        $products= $this->service->listProduct();
        return view('Product.listProduct',["products"=>$products]);
    }
}
