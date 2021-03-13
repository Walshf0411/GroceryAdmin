<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\TempProduct2Service;

class TempProduct2ApiController extends Controller
{
    //
    public function __construct(TempProduct2Service $service){
        $this->service = $service;
        // $this->middleware("auth:vendor");
    }
    public function addTempProduct(Request $request){
        return response()->json(["message"=>$this->service->addTempProduct($request)], 200);
    }
    public function deleteTempProduct($id){
        return response()->json(["message"=>$this->service->deleteTempProduct($id)], 200);
    }
    public function editTempProduct($id, Request $request){
        return response()->json(["message"=>$this->service->editTempProdcut($id, $request)], 200);
    }

    public function listVendorTempProducts($id){
        return response()->json(["tempProducts"=>$this->service->listVendorTempProducts($id)], 200);
    }

}
