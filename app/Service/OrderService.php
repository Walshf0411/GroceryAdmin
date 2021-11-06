<?php

namespace App\Service;

use App\Mail\Customer\OrderUpdatedMail;
use App\Model\Address;
use App\Model\TempProduct2;
use App\Model\Product2;
use App\Model\Category;
use App\Model\Delivery_cost;
use App\Model\DeliveryBoy;
use App\Model\ModeOfPayment;
use App\Model\Vendor;
use App\Model\Orders;
use App\Model\OrderDescription;
use App\Model\Product;
use App\Model\Status;
use App\Model\Timeslot;
use App\Notifications\Customer\OrderPlacedNotification;
use App\Notifications\Customer\OrderUpdatedNotification;
use App\Notifications\Vendor\OrderReceivedNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
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
        }

        $productsByVendor = [];

        foreach ($order->products as $product) {
            $productsByVendor[$product->vendor->id][] = $product;
        }

        foreach($productsByVendor as $vendorId => $productsList) {
            Vendor::find($vendorId)->notify(new OrderReceivedNotification($order->id, $productsList));
        }

        // Notify the customer about the order being placed
        $order->customer->notify(new OrderPlacedNotification($order));

        return [$order->id, "success"];
    }

    public function getOrdersByCustomer($id){
        $orders = Orders::where("customer_id", $id)->get();
        $final_orders = array();
        foreach($orders as $order){
            $orderdescription = DB::select('select * from orderdescription where order_id = ? order by created_at desc', [$order->id]);
            if($orderdescription==[]){return "there is some error";}
            $rider = DeliveryBoy::where("id", $order->rider_id)->get();
            if(count($rider) == 1){$order->rider = $rider['0'];}
            else{$order->rider = null;}
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
        $order = DB::select("select o.* from orders as o, orderdescription AS od where od.vendor_id = ? and od.order_id = o.id", [$id]);
        foreach($order as $item){
            $rider = DeliveryBoy::where("id", $item->rider_id)->get();
            if(count($rider) == 1){
                $item->rider = $rider['0'];
            }else{
                $item->rider = null;
            }
        }
        return $order;
    }

    public function assignedOrder($id, Request $request){
        $order = Orders::find($id);
        // dd($order);
        if($order==null){
            return false;
        }
        $order->rider_id  = $request->rider_id;
        return $order->save();
    }
    public function getOrderDetails($id){
        $orderDesc = OrderDescription::where("order_id", $id)->get();
        foreach($orderDesc as $item){
            $item->vendor = Vendor::where("id", $item->vendor_id)->get()['0'];
            $item->product = Product2::where("id", $item->product_id)->get()['0'];
        }
        return $orderDesc;
      }

      public function getOrder($id){
        return Orders::where("id", $id)->get();
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

    public function getUnassignedOrdersDetails(){
        return Orders::where("status", "Pending")
        ->where("rider_id", 0)->get();
    }




    public function listOrderDescription(){
        return OrderDescription::all();
    }

    public function deleteOrder($id){
        OrderDescription::where("order_id", $id)->delete();
        return Orders::where("id", $id)->delete();
    }

    public function editOrder(int $id, $request){
        Orders::findOrFail($id)->update($request);
    }
    // public function editOrderDescription(int $id, $request){
    //     OrderDescription::findOrFail($id)->update($request);
    // }
    public function getSingleOrder($id){
        $order = (object)[];
        $details =DB::table("orders")->where("id",$id)->get();
        // dd($details);
        if(count($details)==0) return $order;
        $order->details = $details['0'];
        $description = DB::table("orderdescription")->where("order_id", $id)->get();
        $amount = 0;
        foreach($description as $item){
            $item->vendor = DB::table("vendors")->where("id", $item->vendor_id)->get()['0'];
            $item->product = DB::table("product2")->where("id", $item->product_id)->get()['0'];
            $amount = $amount +(($item->price )*($item->counts));
        }
        $order->details->amount = $amount ;
        $order->description = $description;
        $order->address = DB::table("address")->where("customer_id", $order->details->customer_id)->get();
        $order->timeslots = Timeslot::all();
        $order->status = Status::all();
        $order->rider = DeliveryBoy::all();
        $order->mop = ModeOfPayment::all();
        // dd($order);
        $order->details->delivery_charges = Delivery_cost::all()['0']->delivery_charges;
        return $order;
    }

    public function amount($id){
        // $detail= DB::select("select * from orders where id = ?",[$id]); #13
        // $des = DB::select("select count from orderdescription where order_id = ?",[$id]);
        // $desp = DB::select("select o.counts ,p.price from product2 as p , orderdescription as o
        // where o.order_id = ? and p.id=o.product_id",[$id]);
         // foreach($desp as $de){
        //     $amount = $amount + (($de->price) * ($de->counts));
        // }
        $order = $this->getSingleOrder($id);
        $amount =0;
        foreach(($order->description) as $de){
            $amount = $amount +(($de->product->price )*($de->counts));
        }
        return $amount;

    }

    public function updateOrder($request, int $id){
        // $order = Orders::where("id", $id)->get();
        // dd($request);
        // if(!
        $bol = Orders::findOrFail($id)->update($request);
        return $bol;
        // )
        // {return false;}
        // if(count($order) == 1){
        //     $order->customer->notify(new OrderUpdatedMail($order));

        //     $orderd = OrderDescription::where("order_id", $id)->get();
        //     $productsByVendor = [];

        //     foreach ($orderd as $product) {
        //         $productsByVendor[$product->vendor->id][] = $product;
        //     }

        //     foreach($productsByVendor as $vendorId => $productsList) {
        //         Vendor::find($vendorId)->notify(new OrderReceivedNotification($order->id, $productsList));
        //     }

        //     // Notify the customer about the order being placed
        //     $order->customer->notify(new OrderUpdatedNotification($order));

            // return true;
        }
        // return false;
    public function editOrderDescription($id){
        // $orderdescription = DB::select('select * FROM orderdescription where id = ?', [$id]);
        $orderDesc = OrderDescription::where("id", $id)->get();
        foreach($orderDesc as $item){
            $item->vendor = Vendor::where("id", $item->vendor_id)->get()['0'];
            $item->product = Product2::where("id", $item->product_id)->get()['0'];
        }
        if(count($orderDesc)!=1){
            return redirect()->back()->with("error","Data Not Found ");
        }
        return $orderDesc['0'];
    }

    public function updateOrderDescription($request, $id){
            // return OrderDescription::findOrFail($id)->update($request);
            $orderdescription = DB::select('select * from orderdescription where id = ?', [$id]);
        if($orderdescription==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }else{
            return DB::update('update orderdescription set counts = ? , price = ? where id = ?',
            [ $request['counts'],$request['price'],$id]);
        }
    }

    public function addValue($productId,$addedCount){
        return DB::update("update product2 set unit  = unit + ? where id = ?",[$addedCount,$productId]);
    }

    public function checkAvail($productId,$addedCount){
        $quantity = DB::select('select unit from product2 where id = ?',[$productId]);
        $count = $addedCount * -1 ;
        if($quantity==[]){
            return redirect()->back()->with("Error","Product Not Found ");
        }else{
                if($quantity['0']->unit<$count){
                        return false;
                }else{
                        $this->addValue($productId, $addedCount);
                        return true;
                }
        }
    }

    public function deleteOrderDescription($id){

        $bol = DB::select("select count(*) as count, counts, product_id from orderdescription where order_id IN (select order_id from orderdescription where id= ?)", [$id]);
        $desc = OrderDescription::findOrFail($id);
        if($bol['0']->count>1){
            return $this->addValue($desc->product_id, $desc->counts ) && OrderDescription::findOrFail($id)->delete();
        }else{
            return false;
        }
    }
}
