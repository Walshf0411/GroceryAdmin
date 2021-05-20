<?php

namespace App\Http\Controllers;

use App\Model\OrderDescription;
use App\Model\Orders;
use Illuminate\Http\Request;
use App\Service\OrderService;
use Illuminate\Support\Facades\Validator;

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

    public function updateOrder(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
            'customer_id' => 'required|int',
            'address_id' => 'required|int',
            'amount' => 'required',
            'delivery_charges' => 'required',
            'total_amount' => 'required',
            'tiemslot' => 'required|date',
            'status' => 'required|max:255',
            'rider_id' => 'required|int',
            'mode_of_payment' => 'required',
            'date_of_delivery' => 'required',
            'comment' => 'max:255',

          ]);

        if($validator->fails()){
            redirect()->back()->with('error',$validator);
        }
        if($this->service->updateOrder($request->all(), $id)){
        $order->customer->notify(new OrderPlacedNotification($order));

            return redirect()->route('list_order', ["orders"=>$this->service->ordersList()])->with('success', 'Order Edited Successfully');
            // $this->listOrders()->with('success', 'Order Edited Successfully');
        }
        return redirect()->back()->with('error','order could not be edited');
    }
}
