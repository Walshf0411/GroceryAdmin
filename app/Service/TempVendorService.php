<?php

namespace App\Service;

use App\Model\TempVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TempVendorService{

    public function list_temp_Vendor(){
        return DB::select('select * from temp_vendors');

    }

    public function delete_temp_Vendor($id){
        $tempvendors= DB::delete('delete from temp_vendors WHERE id=?',[$id]);
    }

    public function add_temp_Vendor($id){
        $tempvendors = DB::insert('insert into vendors (name,shop_name,address,mobile_number,email_id,password,gst_number, nickname) SELECT name, shop_name,address,mobile_number,email_id,password,gst_number, nickname FROM temp_vendors where id=?',[$id]);
    }

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
                $tempvendor->password  = Hash::make($request->password);
                $tempvendor->message = $request->message;
                $tempvendor->nickname = $request->nickname;
                $tempvendor->save();
                return response()->json($tempvendor);
            }else{
                return response()->json(["message" => "Vendor already exists"], 400);
        }
    }

}
