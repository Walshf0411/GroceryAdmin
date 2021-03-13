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
        return response()->json(["orderId"=>$this->service->addOrder($request)]);
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
