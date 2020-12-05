<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\ApiService;

class BannerApiController
{
    public function __construct(ApiService $service){
        $this->service = $service;
    }

    public function show()
    {
        return $this->service->getHomePage();
    }

    public function showCategory()
    {
        return response()->json(["categories"=>$this->service->getAllCategory()]);

    }

}
