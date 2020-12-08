<?php

namespace App\Service;

use App\Model\TempVendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CustomerService{

    public function listVendor(){
        return DB::select('select * from customers');
    }
}
