<?php

namespace App\Service;

use App\Model\Product2;
use App\Model\TempVendor;
use App\Model\Vendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class VendorService{


    public function listVendor( ){
        return DB::select('select * from vendors where is_blocked = 0');

    }

    public function getProductbyVendor($id){
         return DB::select('select p.* , p.name AS product_name FROM `product2` as p ,`vendors` as v WHERE v.id=p.vendor_id and v.id=?',[$id]);
    }

    public function getVendorById($id){
        return DB::select('select * from vendors where id =?',[$id]);
    }

    public function list_block_vendor(){
        return DB::select('select * from vendors where is_blocked = 1');
    }

    public function block_Vendor($id){
        return DB::update("update vendors set is_blocked = 1 where id=?",[$id]);
    }

    public function unblock_Vendor($id){
        return DB::update("update vendors set is_blocked = 0 where id=?",[$id]);
    }

    public function delete_block_vendor($id){
        $deleteVendor = DB::delete('delete from vendors WHERE id=?',[$id]);
        return "Vendor Deleted Successfully";
    }

    public function vendorStats($id, $data){ 
        return DB::select("SELECT od.product_id, p.name, sum(od.counts) count ,sum(od.price * od.counts) as price, p.description, p.images 
                        FROM orderdescription od, orders o, product2 p 
                        WHERE od.vendor_id= ? AND o.id=od.order_id AND o.status='Delivered' AND o.date_of_delivery> ? AND o.date_of_delivery<? AND p.id = od.product_id 
                        GROUP BY od.product_id", 
                        [
                            $id,
                            date('Y-m-d', strtotime($data['fDate'])),
                            date('Y-m-d', strtotime($data['tDate'])) 
                        ]);
    }

    public function editTempVendor($id, Request $request){

        $tempvendor = Vendor::find($id);
        // dd($tempvendor);
        // DB::select("select * from temp_vendors AS t ,vendors AS v where t.email_id=? or v.email_id=?",[$request->email_id,$request->email_id]);
            // if($tempvendor->count()==1){
                $tempvendor->name = $request->name;
                $tempvendor->shop_name = $request->shop_name;
                $tempvendor->address = $request->address;
                $tempvendor->gst_number = $request->gst_number;
                $tempvendor->nickname = $request->nickname;
                $tempvendor->save();
                return response()->json($tempvendor);
            // }else{
            //     return response()->json(["message" => "Vendor does not exists"], 400);
        // }
    }
}
