<?php

namespace App\Api;
// namespace App\Http\Controllers;
use App\Model\TempVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorApiService
{
    public function create_temp_vendor(Request $request){

        $count = DB::select("select * from temp_vendors AS t ,vendors AS v where t.email_id=? or v.email_id=?",[$request->email_id,$request->email_id]);
            if(count($count)==0){
                $tempvendor = new TempVendor;
                $tempvendor->name = $request->name;
                $tempvendor->shop_name = $request->shop_name;
                $tempvendor->address = $request->address;
                $tempvendor->email_id = $request->email_id;
                $tempvendor->mobile_number = $request->mobile_number;
                $tempvendor->gst_number = $request->gst_number;
                $tempvendor->message = $request->message;
                $tempvendor->save();
                // return response()->json(["message" => "New vendor Added"]);
                return response()->json($tempvendor);
            }else{
                return response()->json(["message" => "Vendor already exists"]);
        }

    }

}


