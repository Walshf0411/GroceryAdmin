<?php

namespace App\Service;
// namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\Customer;
use App\Model\DeliveryBoy;
use App\Model\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeliveryBoyService{
    public function login(Request $request){
        $credentials = request()->only(['phoneno','password' ]);
        $token = auth('deliveryboy')->attempt($credentials);
        if($token){
            $deliveryboy = DeliveryBoy::where("phoneno", "=", $request->phoneno)->get();

            return response()->json(["token"=>$token, 'deliveryboy'=>$deliveryboy[0]],200);
        }else{
            return response()->json(["error"=> "wrong credentials"],401);
        }
    }

    public function getListOfOrdersByRider(int $id, $orderStatus){
        $orders = DB::table('orders')
                    ->where("rider_id", "=", $id)
                    ->where("status", "like", $orderStatus)
                    ->orderBy("id")->get();

        $final_orders = array();
        foreach($orders as $order){
            $order->address = Address::whereRaw("id = ? and customer_id = ?",
                                [$order->customer_id, $order->address_id]
                            )->first();

            $order->customer = Customer::findOrFail($order->customer_id, ["c_name", "mobile_number", "email_id"]);

            unset($order->address_id);
            unset($order->customer_id);

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

    public function addDelievryBoy(Request $request){
        $deliveryboy = new DeliveryBoy;
        $deliveryboy->name = $request->name;
        $deliveryboy->phoneno = $request->phoneno;
        $deliveryboy->email = $request->email;
        $deliveryboy->password = Hash::make($request->password);
        $deliveryboy->address = $request->address;

        $deliveryboy->save();

        return "Delivery Boy Details Saved Successfully";
    }

    public function editDeliveryBoy($request, $id){
        $deliveryboy = DeliveryBoy::findOrFail($id);
        $deliveryboy->name = $request->name;
        $deliveryboy->phoneno = $request->phoneno;
        $deliveryboy->email = $request->email;
        if(trim($request->password)!="") {$deliveryboy->password = Hash::make($request->password);};
        $deliveryboy->address = $request->address;
        $deliveryboy->is_available = $request->availablity;
        $deliveryboy->save();
        return "Delivery Boy Details edited Successfully";
    }

    public function deleteDeliveryBoy($id){
        $deliveryboy = DeliveryBoy::findOrFail($id)->delete();
        return "Delivery Boy Deleted Successfullly";
    }
    public function getDeliveryBoyAvailability($riderId) {
        $cancelled = Orders::select(DB::raw('count(*) as cancelled'))
        ->where("rider_id", $riderId)
        ->where("status", "Cancelled")->get();
        $delivered = Orders::select(DB::raw('count(*) as delivered'))
        ->where("rider_id", $riderId)
        ->where("status", "Delivered")->get();
        $sales = Orders::select(DB::raw('sum(total_amount) as sales'))
        ->where("rider_id", $riderId)
        ->where("status", "Delivered")->get();

        $message  = (object)[];
        $message->status =DeliveryBoy::findOrFail($riderId)->is_available;
        $message->cancelled = $cancelled['0']->cancelled;
        $message->delivered = $delivered['0']->delivered;
        $message->sales = $sales['0']->sales;
        return $message;
    }

    public function updateDeliveryBoy(int $riderId, $data) {
        if(isset($data['password'])){$data["password"] = Hash::make($data["password"]);}
        // dd($data['password']);
        DeliveryBoy::findOrFail($riderId)->update($data);
    }


    public function completeOrder(int $orderId, $customerSignature) {
        $order = Orders::findOrFail($orderId);

        if ($order->status != "Out For Delivery") {
            return false;
        }
        $file = base64_decode($customerSignature);
        $safeName = "1.png";
        $path = storage_path("app/public/images/CustomerSignatures/$orderId/");
        if (!File::exists($path)) {
            File::makeDirectory($path);
        }

        $success = File::put($path.$safeName, $file);
        if(!$success){
            return false;
        }

        $order->status = "Delivered";
        $order->customer_signature = $safeName;

        return $order->save();
    }

}
?>
