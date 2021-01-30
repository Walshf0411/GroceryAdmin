<?php

namespace App\Service;

use App\Model\TempVendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TempVendorService{

    public function list_temp_Vendor(){
        return DB::select('select * from temp_vendors');

    }

    public function delete_temp_Vendor($id){
        $tempvendors= DB::delete('delete from temp_vendors WHERE id=?',[$id]);
    }

    public function add_temp_Vendor($id){
        $tempvendors = DB::insert('insert into vendors (name,shop_name,address,mobile_number,email_id,password,gst_number) SELECT name, shop_name,address,mobile_number,email_id,password,gst_number FROM temp_vendors where id=?',[$id]);
    }
}
