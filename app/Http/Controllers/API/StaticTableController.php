<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\StaticTableService;

class StaticTableController extends Controller
{
    //
    public function __construct(StaticTableService $service){
        $this->service = $service;
    }
    public function getTc(){
        return response()->json(["content" => $this->service->getTc()], 200);
    }
    public function getAbout(){
        return response()->json(["content" => $this->service->getAboutUs()], 200);
    }
    public function getShare(){
        return response()->json(["content" => $this->service->getShare()], 200);
    }
    public function getRpSecretKey(){
        return response()->json(["value"=>$this->service->getRpSecretKey()], 200);
    }
}
