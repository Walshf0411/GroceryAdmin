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

    public function deleteOrder($id){
        $delete = $this->service->deleteOrder($id);
        if($delete){return $this->listOrders()->with('success', 'Order Deleted Successfully');}
        else{return redirect()->back()->with('error','order could not be deleted');}
    }

    public function editOrder($id){
        $order = $this->service->getSingleOrder($id);
        if($order!=(object)[]){
            return view('Order.editOrder', ["order"=>$order]);
        }else{
            return redirect()->back()->with('error','this order does not exists');
        }
    }
}
