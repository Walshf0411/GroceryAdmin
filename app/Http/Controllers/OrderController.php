<?php

namespace App\Http\Controllers;

use App\Model\OrderDescription;
use App\Model\Orders;
use Illuminate\Http\Request;
use App\Service\OrderService;
class OrderController extends Controller
{

    public function __construct(OrderService $service){
        $this->service = $service;
        $this->middleware('auth');
    }

    public function editOrderDescription(OrderDescription $orderdescription,$id)
    {
        $orderdescription =  $this->service->editOrderDescription($id);
        return view('Order.editOrderDescription', ['orderdescription'=> $orderdescription]);
    }

    public function updateOrderDescription(Request $request,$id)
    {
        // $request->validate([
        //     "id" => "required|int",
        //     "order_id" => "required|int",
        //     'vendor_id' => 'required|int',
        //     "product_id" => "required|int",
        //     "counts"=> "required|int",
        // ]);
        $addedCount = $request->value - $request->counts;
        $bol = true;
        if($addedCount<0){
                $bol = $this->service->checkAvail($request->productId, $addedCount);
        }else{
                $this->service->addValue($request->productId,$addedCount);
                $this->service->updateOrderDescription($request->all() ,$id);
                return redirect()->route('orderDescription.list')->with("success","updated successfully");
        }

        if($bol){
                $this->service->updateOrderDescription($request->all() ,$id);
                return redirect()->route('orderDescription.list')->with("success","updated successfully");
        }else{
                return redirect()->route('orderDescription.list')->with("error","Stock not available");
        }

    }

    public function listOrderDescription(){
        $orderdescription = $this->service->listOrderDescription();
        return view('Order.listOrderDescription', ['orderdescription'=>$orderdescription]);
    }

    public function listOrders(){
        $orders= $this->service->ordersList();
        return view('Order.list_order',["orders"=>$orders]);
    }

    public function pendingOrders(){
        $pendingorders= $this->service->pendingOrdersList();
        return view('Order.pending_order',["pendingorders"=>$pendingorders]);
    }

    public function completedOrders(){
        $completedorders= $this->service->completeOrdersList();
        return view('Order.completed_order',["completedorders"=>$completedorders]);
    }

    public function cancelledOrders(){
        $cancelledorders= $this->service->cancelledOrdersList();
        return view('Order.cancelled_order',["cancelledorders"=>$cancelledorders]);
    }

//     public function getOrdersByCustomer($id){
//         $orders= $this->service->getOrdersByCustomer($id);
//         return view('Order.list_order',["orders"=>$orders]);
// }

    public function orderDetails($id)
    {
        $orderdetails =  $this->service->getOrderDetails($id);
        return view('Order.order_details', ['orderdetails'=> $orderdetails]);
    }

    public function unassignedOrders(){
        $orders = $this->service->getUnassignedOrdersDetails();
        return view('Order.unassigned_orders', ["orders" => $orders]);
    }
}
