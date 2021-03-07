<?php

namespace App\Http\Controllers;

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

    public function getOrdersByCustomer($id){
        $orders= $this->service->getOrdersByCustomer($id);
        return view('Customer.list_customerorder',["orders"=>$orders]);
}


}
