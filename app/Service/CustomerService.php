<?php

namespace App\Service;

use App\Model\TempVendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CustomerService{

    public function listCustomer(){
        return DB::select('select * from customers');
    }

    public function getCustomerById($id){
        $customer = DB::select('select * from customers where id=?',[$id]);
        return $customer;
    }
}
