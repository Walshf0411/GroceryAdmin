<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Delivery_cost;
use App\Service\DeliveryService;


class DeliverycostApiController extends Controller
{

    public function __construct(DeliveryService $service){
        $this->service = $service;
        // $this->middleware('auth:vendor');
    }
    public function listDeliveryCosts(){
        return response()->json(["delivery_cost"=>$this->service->listDeliveryCost()],200);
    }
}

