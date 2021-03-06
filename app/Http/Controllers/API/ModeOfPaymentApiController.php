<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\ModeOfPaymentService;
use Illuminate\Http\Request;

class ModeOfPaymentApiController extends Controller
{
    //
    public function __construct(ModeOfPaymentService $service){
        $this->service = $service;
    }
    public function getAllModes(){
        return response()->json(["modes"=>$this->service->getAllModes()]);
    }
}
