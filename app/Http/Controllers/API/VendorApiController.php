<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\VendorApiService;

class VendorApiController extends Controller
{
    //
    public function __construct(VendorApiService $service){
        $this->service = $service;
    }

    public function create(Request $request)
    {
        return $this->service->create_temp_vendor($request);
    }
}
