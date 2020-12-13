<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\VendorApiService;
use App\Service\VendorLoginService;
use App\Service\VendorService;
use  Illuminate\Support\Facades\Hash;
class VendorApiController extends Controller
{
    //

    public function __construct(VendorService $service){
        $this->service = $service;
        // $this->middleware('auth:vendor');
    }

    public function create(Request $request)
    {
        return $this->service->create_temp_vendor($request);
    }

    public function trial(){

        return "Welcome vendor";
    }
}
