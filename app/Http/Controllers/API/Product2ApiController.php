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

}
