<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\ProductService;

class ProductApiController extends Controller
{
    //
    public function __construct(ProductService $service){
        $this->service = $service;
        $this->middleware("auth:vendor");
    }

    public function selectedProducts($vendor_id){
        return response()->json(["products"=>$this->service->viewSelectedProducts($vendor_id)],200);
    }



}

