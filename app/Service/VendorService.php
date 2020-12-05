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


    public function listVendorProduct(){
        $vendordetails = DB::select('select b.vendor_id,v.name,v.shop_name FROM `business` AS b,`vendors` AS v WHERE b.vendor_id=v.id group by vendor_id' );
        return view('Vendor.list_vendorproduct', ["vendordetails"=> $vendordetails]);
    }

    public function show_product($id){
        $vendordetails = DB::select('select p.name,b.price,b.description FROM `business` AS b,`products`AS p,`vendors` AS v WHERE b.product_id=p.id and b.vendor_id=v.id and b.vendor_id=?', [$id]);
        $vendorprofiledetails=DB::select('select v.name,v.shop_name,v.address,v.mobile_number,v.email_id,v.rating,v.gst_number FROM `business` AS b,`products`AS p,`vendors` AS v, `categories` AS c WHERE b.vendor_id=v.id and b.vendor_id=? limit 1', [$id]);
        // if($product==[]){
        //     return redirect()->back()->with("Error","Data Not Found ");
        // }
        return view('Vendor.show_product', ['vendordetails'=> $vendordetails, 'vendorprofiledetails'=> $vendorprofiledetails]);
    }
    // SELECT p.name FROM `business` AS b,`products`AS p WHERE b.product_id=p.id and b.vendor_id=1
}
