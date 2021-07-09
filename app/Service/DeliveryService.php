<?php

namespace App\Service;
// namespace App\Http\Controllers;
use App\Model\Delivery_cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryService{

    public function insertDeliveryCost(Request $request){
        $delivery_cost = DB::select('select * from delivery_costs');
        if(count($delivery_cost) == 1)
        {
            return "error";
            // return redirect()->back()->with("Error","Data Already Exit Just Update ");
        }else{

            $delivery_cost = new Delivery_cost;
            $delivery_cost->delivery_charges = $request->delivery_charges;
            $delivery_cost->save();
            return "success";
        }
    }

    public function editDeliveryCost(){
        $delivery_cost = DB::select('select * from delivery_costs LIMIT 1');
        if($delivery_cost==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        return $delivery_cost;
    }
    public function editDeliveryLimit(){
        $delivery = DB::select("select content from statictable where page='delivery_limit'")[0];
        if($delivery==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        return $delivery;
    }
    public function updateDeliveryCost(Request $request){
        $delivery_cost = DB::select('select * from delivery_costs');
        if($delivery_cost==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        elseif(count($delivery_cost)>1)
        {
            return redirect()->back()->with("Error");
        }else{
            return DB::update('update delivery_costs set delivery_charges = ?', [ $request->delivery_charges]);
        }
    }
    public function updateDeliveryLimit(Request $request){
        $delivery_cost = DB::select("select content from statictable where page='delivery_limit'");
        if($delivery_cost==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        elseif(count($delivery_cost)>1)
        {
            return redirect()->back()->with("Error");
        }else{
           return DB::update("update statictable set content = ? where page='delivery_limit'", [ $request->delivery_charges]);
        }
    }

    public function deleteDeliveryCost(){
        $delivery_cost = DB::select('delete FROM delivery_costs LIMIT 1');
        // return response()->json(["message" => "Data deleted Successfully"]);
    }


    public function listDeliveryCost(){
        $delivery = (object)[];
        $delivery->cost = DB::select('select delivery_charges from delivery_costs')[0];
        $delivery->limit = DB::select("select content from statictable where page='delivery_limit'")[0];
        return $delivery;

        // $delivery_cost = DB::select('select * from delivery_costs');
        // if (count($delivery_cost) == 1){
            // dd($delivery_cost['0']->delivery_charges);
            // return $delivery_cost['0']->delivery_charges;
        // }
        // else{
        //     return response()->json(["message" => "Data Error"],400);
        // }
    }
}
