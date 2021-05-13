<?php

namespace App\Service;

use App\Model\TempProduct2;
use App\Model\Product2;
use App\Model\Category;
use App\Model\Vendor;
use App\Model\Orders;
use App\Model\OrderDescription;
use App\Notifications\Customer\OrderPlacedNotification;
use App\Notifications\Vendor\OrderReceivedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class OrderService{

    public function addOrder(Request $request){
        $order = new Orders();
        $order->customer_id = $request->customer_id;
        $order->address_id = $request->address_id;
        $order->amount = $request->amount;
        $order->delivery_charges = $request->delivery_charges;
        $order->total_amount = $request->total_amount;
        $order->timeslot = $request->timeslot;
        $order->status = $request->status;
        $order->rider_id = 0;
        $order->mode_of_payment = $request->mode_of_payment;
        $order->date_of_delivery = $request->date_of_delivery;
        $order->comment = $request->comment;
        if(isset($request->payment_id)){
            $order->payment_id = $request->payment_id;
        }
        $order->save();

        foreach($request->order_description as $order_description){
            $unit = Product2::findOrFail($order_description['product_id'])->unit;
            if($unit<$order_description['counts']){
                DB::delete('delete order where id = ?', [$order->id]);
                return [$order_description['prodcut_id'], "error"];
            }else{
                $val = $unit-$order_description['counts'];
                DB::update('update product2 set unit = ? where id = ?', [$val, $order_description['counts']]);
            }
            $orderdescription  = new OrderDescription;
            $orderdescription->order_id = $order->id;
            $orderdescription->vendor_id = $order_description['vendor_id'];
            $orderdescription->product_id = $order_description['product_id'];
            $orderdescription->counts = $order_description['counts'];
            $orderdescription->save();

            $orderdescription->vendor->notify(new OrderReceivedNotification($orderdescription));
        }

        // Notify the customer about the order being placed
        $order->customer->notify(new OrderPlacedNotification($order));

        return [$order->id, "success"];
    }

    public function getOrdersByCustomer($id){
        $orders = DB::select('select * from orders where customer_id = ?', [$id]);
        $final_orders = array();
        foreach($orders as $order){
            $orderdescription = DB::select('select * from orderdescription where order_id = ? order by created_at desc', [$order->id]);
            if($orderdescription==[]){return "there is some error";}
            $finalOrderdescription = array();
            foreach($orderdescription as $orderdesc){
                $orderdesc->vendor = DB::select('select * from vendors where id = ?', [$orderdesc->vendor_id])['0'];
                $orderdesc->product = DB::select('select * from product2 where id = ?', [$orderdesc->product_id])['0'];
                array_push($finalOrderdescription, $orderdesc);
            }
            $order->order_description = $finalOrderdescription;
            array_push($final_orders, $order);
        }
        return $final_orders;
    }

    public function cancelOrder(int $id, $comment) {
        $orderDetails = DB::select("SELECT status FROM orders WHERE id = ?", [$id]);

        if (count($orderDetails) == 0) {
            return false;
        } else if (count($orderDetails) > 1 || $orderDetails[0]->status != "Pending") {
            return false;
        }

        $description = DB::select("select * from orderdescription where order_id = ?",[$id]);

        foreach($description as $detail){
            DB::update("update product2 set unit = unit + ? where id = ?",[$detail->counts, $detail->product_id]);
        }

        return DB::update("update orders set status = 'Cancelled', comment = ? where id = ? ",[$comment, $id]);
    }

    public function updateOrderStatus(int $id, $status) {
        $orderDetails = DB::select("SELECT * FROM orders WHERE id = ?", [$id]);

        if (count($orderDetails) == 0 || count($orderDetails) > 1) {
            return false;
        }

        return DB::update("UPDATE orders SET status = ? WHERE id = ? ",[$status, $id]);
    }


    //vendor

    public function getOrderByVendor($id) {
        return DB::select("select * from orders as o, orderdescription AS od where od.vendor_id = ? and od.order_id = o.id", [$id]);
    }

    public function getOrderDetails($id){
        return DB::select("select p.*,v.name as vendor_name from product2 as p,vendors as v, orderdescription AS od where od.order_id = ? and od.product_id = p.id and od.vendor_id=v.id order by p.id DESC", [$id]);
      }


    public function ordersList(){
        return Orders::all();
    }

    public function pendingOrdersList(){
        return DB::select('select * from orders where status = "pending"');
    }

    public function completeOrdersList(){
        return DB::select('select * from orders where status = "completed"');
    }

    public function cancelledOrdersList(){
        return DB::select('select * from orders where status = "cancelled"');
    }



}
