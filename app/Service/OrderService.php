<?php

namespace App\Service;

use App\Model\TempProduct2;
use App\Model\Product2;
use App\Model\Category;
use App\Model\Vendor;
use App\Model\Orders;
use App\Model\OrderDescription;
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
        $order->save();



        foreach($request->order_description as $order_description){
            $orderdescription  = new OrderDescription;
            $orderdescription->order_id = $order->id;
            $orderdescription->vendor_id = $order_description['vendor_id'];
            $orderdescription->product_id = $order_description['product_id'];
            $orderdescription->counts = $order_description['counts'];
            $orderdescription->save();
        }
        //for loop to iterate through products and insert them using order id

        return "Order Placed Successfully";
    }

    public function getOrdersByCustomer($id){
        $orders = DB::select('select * from orders where customer_id = ?', [$id]);
        $final_orders = array();
        foreach($orders as $order){
            $orderdescription = DB::select('select * from orderdescription where order_id = ?', [$order->id]);
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

    public function cancellOrder($id){
        DB::update("update orders set status = 'Cancelled' where id = ? ",[$id]);
        return "Order Cancelled Sucessfully";
    }


    //vendor

    public function getOrderByVendor($id) {
        return DB::select("select * from orders as o, orderdescription AS od where od.vendor_id = ? and od.order_id = o.id", [$id]);
    }


    public function orderList(){
        return Orders::all();
    }

    public function orderDetails(){
        return DB::select('select * from orders');
    }





}
