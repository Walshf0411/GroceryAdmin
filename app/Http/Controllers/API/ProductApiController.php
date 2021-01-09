<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\ProductApiService;

class ProductApiController extends Controller
{
    //
    public function __construct(ProductApiService $service){
        $this->service = $service;
    }


    

}

