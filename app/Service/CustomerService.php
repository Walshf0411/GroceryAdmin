<?php

namespace App\Service;

use App\Model\TempVendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CustomerService{

    public function listVendor(){
        $customerdetails = DB::select('select * from customers');
        return view('Customer.list_customer', ["customerdetails"=> $customerdetails]);
    }
}
