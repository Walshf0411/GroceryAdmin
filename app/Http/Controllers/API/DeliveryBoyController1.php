<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\DeliveryBoyService1;


class DeliveryBoyController1 extends Controller {

    public function __construct(DeliveryBoyService1 $service){
        $this->service = $service;
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

        $this->service->updateDeliveryBoy($request->rider_id, ["is_available", $request->available]);

        return response()->json([
            "status" => "Success",
            "message" => "Availability updated successfully."
        ]);
    }
}
?>
