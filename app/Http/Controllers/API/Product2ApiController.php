<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Product2Service;

class Product2ApiController extends Controller
{
    //
    public function __construct(Product2Service $service){
        $this->service = $service;
    }

    public function getAllVendorProducts($id){
        return response()->json(["products"=>$this->service->getAllVendorProducts($id)]);
    }

    public function listVendorTempProducts($id){
        return response()->json(["tempProducts"=>$this->service->listTempProdcuts($id)], 200);
    }

    // public function insertProduct(Request $request){
    //     return response()->json(["message"=>$this->service->insertProduct($request)], 200);
    // }

    public function editProduct(Request $request,$id){
        return response()->json(["message"=>$this->service->editProductByVendor($request,$id)], 200);
    }
    public function deleteProduct($id){
        return response()->json(["message"=>$this->service->deleteProduct($id)], 200);
    }

    public function popularProductsList(){
        return response()->json(["popular_products"=>$this->service->homeListProduct()], 200);
    }

    public function listProduct(){
        return response()->json(["products"=>$this->service->listProduct()], 200);
    }


}
