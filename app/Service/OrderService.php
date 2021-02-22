<?php

namespace App\Service;

use App\Model\TempProduct2;
use App\Model\Product2;
use App\Model\Category;
use App\Model\Vendor;
use App\Model\Orders;
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
        $order->save();

        $order->id;
        //for loop to iterate through products and insert them using order id
        
        return null;
    }
}