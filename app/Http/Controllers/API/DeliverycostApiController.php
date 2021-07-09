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
        $response = (object)[];
        $response->message = "Success";
        $data = $this->service->listDeliveryCost();
        $response->details = (object)[];
        $response->details->delivery = (object)[];
        $response->details->delivery->cost = $data->cost->delivery_charges;
        $response->details->delivery->limit = (float)$data->limit->content;
        return response()->json($response,200);
    }
}

