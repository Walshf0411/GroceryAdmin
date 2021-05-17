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
    public function cancellOrder(Request $request, int $id)
    {
        $request->validate([
            "comment" => "required|string"
        ]);

        $updateStatus = $this->service->cancelOrder($id, $request->comment);

        return response()
                ->json([
                    "status" => $updateStatus ? "Success": "Failure",
                    "message" => $updateStatus ? "Order cancelled successfully!": "Order could not be cancelled"
                ], $updateStatus ? 200: 400);
    }
    //vendor
    public function getOrderByVendor($id){
        return response()->json(["responsePayload"=>$this->service->getOrderByVendor($id)]);
    }

    public function updateOrderStatus(Request $request) {
        $request->validate([
            "order_id" => "required|int",
            "status" => "required|string"
        ]);

        $updateStatus = $this->service->updateOrderStatus($request->order_id, $request->status);

        return response()
                ->json([
                    "status" => $updateStatus ? "Success": "Failure",
                    "message" => $updateStatus ? "Order status updated successfully!": "Order status could not be updated"
                ], $updateStatus ? 200: 400);
    }
    public function getOrderDetails($id){
        return response()->json(["message"=>$this->service->getOrderDetails($id)]);
    }
}
