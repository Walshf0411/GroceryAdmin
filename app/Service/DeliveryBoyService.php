<?php

namespace App\Service;
// namespace App\Http\Controllers;
use App\Model\DeliveryBoy;
use App\Model\Orders;
use Illuminate\Http\Request;
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

    public function getListOfOrdersByRider($id){
        $orders = DB::table('orders')->where("rider_id", "=", $id)->orderBy("id")->get();
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
        $deliveryboy->save();
        return "Delivery Boy Details edited Successfully";
    }

    public function deleteDeliveryBoy($id){
        $deliveryboy = DeliveryBoy::findOrFail($id)->delete();
        return "Delivery Boy Deleted Successfullly";
    }
    public function getDeliveryBoyAvailability($riderId) {
        return DeliveryBoy::findOrFail($riderId)->is_available;
    }

    public function updateDeliveryBoy(int $riderId, $data) {
        DeliveryBoy::findOrFail($riderId)->update($data);
    }
}
?>
