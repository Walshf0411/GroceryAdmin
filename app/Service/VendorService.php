<?php

namespace App\Service;

use App\Model\TempVendor;
use App\Model\Vendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class VendorService{


    public function listVendor(){
        return DB::select('select * from vendors where is_blocked = 0');

    }

    public function listVendorProduct(){
        return DB::select('select b.*,v.name,p.unit,p.name AS product_name ,c.category_name FROM `business` AS b,
        `vendors` AS v ,`products` AS p ,`categories` AS c WHERE b.vendor_id=v.id and b.product_id=p.id and b.category_id=c.id' );
    }

    public function show_product($id){
        $vendordetails = DB::select('select p.name,p.unit,b.price,b.description FROM `business` AS b,`products`AS p,`vendors` AS v WHERE b.product_id=p.id and b.vendor_id=v.id and b.vendor_id=?', [$id]);
        $vendorprofiledetails=DB::select('select v.name,v.shop_name,v.address,v.mobile_number,v.email_id,v.rating,v.gst_number FROM `business` AS b,`products`AS p,`vendors` AS v, `categories` AS c WHERE b.vendor_id=v.id and b.vendor_id=? limit 1', [$id]);
        return  [$vendordetails, $vendorprofiledetails];
    }
    public function create_temp_vendor(Request $request){

        $count = DB::select("select * from temp_vendors AS t ,vendors AS v where t.email_id=? or v.email_id=?",[$request->email_id,$request->email_id]);
            if(count($count)==0){
                $tempvendor = new TempVendor;
                $tempvendor->name = $request->name;
                $tempvendor->shop_name = $request->shop_name;
                $tempvendor->address = $request->address;
                $tempvendor->email_id = $request->email_id;
                $tempvendor->password = $request->password;
                $tempvendor->mobile_number = $request->mobile_number;
                $tempvendor->gst_number = $request->gst_number;
                $tempvendor->message = $request->message;
                $tempvendor->save();
                // return response()->json(["message" => "New vendor Added"]);
                return response()->json($tempvendor);
            }else{
                return response()->json(["message" => "Vendor already exists"],400);
        }

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
        return $deleteVendor;
    }
}
