<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\ModeOfPayment;

class ModeOfPaymentService{
    public function getAllModes(){
        return DB::select('select * from mode_of_payment');
    }
}

?>