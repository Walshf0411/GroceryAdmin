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
        return $this->service->getAllVendorProducts($id);
    }

    public function listVendorTempProducts($id){
        return response()->json(["tempProducts"=>$this->service->listTempProdcuts($id)], 200);
    }

    public function insertProduct(Request $request){
        return response()->json(["message"=>$this->service->insertProduct($request)], 200);
    }

    public function editProduct(Request $request,$id){
        return response()->json(["message"=>$this->service->editProduct($request,$id)], 200);
    }
    public function deleteProduct($id){
        return response()->json(["message"=>$this->service->deleteProduct($id)], 200);
    }

}
