<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\TempProductService;
class TempProductController extends Controller
{
    //
    public function __construct(TempProductService $service){
        $this->service = $service;
        // $this->middleware('auth:vendor');
    }

    public function create(Request $request)
    {
        return $this->service->create_temp_product($request);
    }

    public function test(Request $request)
    {
        return $this->service->test($request);
    }

    public function vendorsProductList($id){
        return response()->json(["products"=>$this->service->listTempProducts($id)], 200);
    }
}
