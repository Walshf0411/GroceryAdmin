<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\VendorLoginService;
use Illuminate\Http\Request;

class VendorLoginController extends Controller
{
    public function __construct(VendorLoginService $vendorLoginService){
        $this->vendorLoginService = $vendorLoginService;
    }

        return $this->vendorLoginService->login($request);
    }

    public function unauthorized(){
        return response()->json(["error"=>"login karo bhai"], 401);
    }
