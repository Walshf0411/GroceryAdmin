<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\ApiService;

class BannerApiController extends Controller
{
    public function __construct(ApiService $service){
        $this->service = $service;
    }

    public function show(Request $request)
    {
        return $this->service->getAllBanner();
    }



}
