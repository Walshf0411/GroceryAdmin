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

    public function addOrder(Request $request){
        return response()->json(["message"=>$this->service->addOrder($request)]);
    }
    public function getOrdersByCustomer($id){
        return response()->json(["responsePayload"=>$this->service->getOrdersByCustomer($id)]);
    }
}
