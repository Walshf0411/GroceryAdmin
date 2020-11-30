<?php

namespace App\Service;

use App\Model\TempVendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class VendorService{

    public function listVendor(){
        $vendordetails = DB::select('select * from vendors');
        return view('Vendor.list_vendor', ["vendordetails"=> $vendordetails]);
    }


    public function listVendorProduct($id){
        $vendordetails = DB::select('select name ,vendor_id FROM `temp_products` WHERE vendor_id=?',[$id]);
        return view('Vendor.list_vendorproduct', ["vendordetails"=> $vendordetails]);
    }
}
