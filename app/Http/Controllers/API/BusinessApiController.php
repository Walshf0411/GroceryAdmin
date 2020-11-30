<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\BusinessApiService;

class BusinessApiController extends Controller
{
    //
    public function __construct(BusinessApiService $service){
        $this->service = $service;
    }

    public function store(Request $request)
    {
        return $this->service->insertBusiness($request);
    }

    public function update(Request $request, $id)
    {
        return $this->service->updateBusiness($request,$id);
    }
    public function destroy($id)
    {
        return $this->service->deleteBusiness($id);
    }

}
