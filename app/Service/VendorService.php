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
}
