<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Timeslot;
use App\Service\TimeslotService;
use Illuminate\Http\Request;

class TimeslotApiController extends Controller{

    public function __construct(TimeslotService $service){
        $this->service = $service;
        // $this->middleware('auth:vendor');
    }
    public function listTimeslots(){
        return response()->json(["timeslots"=>$this->service->listTimeslot()],200);
    }
}
