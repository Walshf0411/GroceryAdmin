<?php

namespace App\Service;
// namespace App\Http\Controllers;
use App\Model\DeliveryBoy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
?>
