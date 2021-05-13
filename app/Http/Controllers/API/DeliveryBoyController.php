<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\DeliveryBoyService;
use Illuminate\Support\Facades\Validator;

class DeliveryBoyController extends Controller
{
    //
    public function __construct(DeliveryBoyService $service){
        $this->service = $service;
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'phoneno' => 'required|max:10',
            'password' => 'required',
          ]);

        if($validator->fails()){
            return response()->json(["message"=>"Enter all details"],400);
        }else{
            return $this->service->login($request);

        }
    }
    
    public function getListOfOrdersByRider($id){
        return response()->json(["orders"=>$this->service->getListOfOrdersByRider($id)]);
    }
    
    public function getDeliveryBoyStatus(Request $request) {
        $request->validate([
            "rider_id" => "required|int"
        ]);
        
        return response()->json([
            "available" => $this->service->getDeliveryBoyAvailability($request->rider_id)
        ]);
    }
    
    public function updateDeliveryBoyDetails(Request $request) {
        $request->validate([
            "rider_id" => "required|int"
        ]);

        $this->service->updateDeliveryBoy($request->rider_id, $request->all());

        return response()->json([
            "status" => "Success",
            "message" => "Rider deails updated successfully."
        ]);
    }

    public function updateDeliveryBoyStatus(Request $request) {
        $request->validate([
            "rider_id" => "required|int",
            "available" => "required|int"
        ]);

        $this->service->updateDeliveryBoy($request->rider_id, ["is_available"=> $request->available]);

        return response()->json([
            "status" => "Success",
            "message" => "Availability updated successfully."
        ]);
    }

}
