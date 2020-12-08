<?php

namespace App\Service;

use App\Model\TempVendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TempVendorService{

    public function listVendor(){
        return DB::select('select * from temp_vendors');

    }

    public function deleteVendor($id){
        $tempvendors= DB::delete('delete from temp_vendors WHERE id=?',[$id]);
    }

    public function addVendor($id){
        $tempvendors = DB::insert('insert into vendors (name,shop_name,address,mobile_number,email_id,gst_number) SELECT name, shop_name,address,mobile_number,email_id,gst_number FROM temp_vendors where id=?',[$id]);
    }
}
