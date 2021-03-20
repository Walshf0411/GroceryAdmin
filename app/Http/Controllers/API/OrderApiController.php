<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    //
    public function __construct(OrderService $service){
        $this->service = $service;
    }
    //customer
    public function addOrder(Request $request){
        $response = $this->service->addOrder($request);
        if($response['1']=='error'){
            return response()->json(["orderId"=>$response['0']], 400);
        }
        return response()->json(["orderId"=>$response['0']], 200);
    }
    public function getOrdersByCustomer($id){
        return response()->json(["responsePayload"=>$this->service->getOrdersByCustomer($id)]);
    }
    public function cancellOrder($id)
    {
        return response()->json(["responsePayload"=>$this->service->cancellOrder($id)]);
    }
    //vendor
    public function getOrderByVendor($id){
        return response()->json(["responsePayload"=>$this->service->getOrderByVendor($id)]);
    }
}
