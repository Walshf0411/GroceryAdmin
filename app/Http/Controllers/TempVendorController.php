<?php

namespace App\Http\Controllers;


use App\Model\TempVendor;
use Illuminate\Http\Request;
use App\Service\TempVendorService;


class TempVendorController extends Controller
{
    //
    public function __construct(TempVendorService $service){
        $this->service = $service;
    }


    public function show()
    {
        return $this->service->listVendor();
    }
    public function store($id)
    {
        return $this->service->addVendor($id);
    }

    public function destroy($id)
    {
        return $this->service->deleteVendor($id);
    }
}
