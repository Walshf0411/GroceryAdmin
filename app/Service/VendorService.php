<?php

namespace App\Service;

use App\Model\TempVendor;
use App\Model\Vendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class VendorService{


    public function listVendor( ){
        return DB::select('select * from vendors where is_blocked = 0');

    }

    // public function listVendorProduct(){
    //     return DB::select('select b.*,v.name,p.unit,p.name AS product_name ,c.category_name FROM `business` AS b,
    //     `vendors` AS v ,`products` AS p ,`categories` AS c WHERE b.vendor_id=v.id and b.product_id=p.id and b.category_id=c.id' );
    // }

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

    
}
