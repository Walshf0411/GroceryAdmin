<?php

namespace App\Http\Controllers;

use App\Model\Vendor;
use Illuminate\Http\Request;
use App\Service\VendorService;

class VendorController extends Controller
{
    //
    public function __construct(VendorService $service){
        $this->service = $service;
    }

    public function show()
    {
        return $this->service->listVendor();
    }
}