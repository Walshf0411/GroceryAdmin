<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\VendorService;

class BusinessController extends Controller
{
    //
    public function __construct(VendorService $service){
        $this->service = $service;
    }

    public function show()
    {
        $vendordetails =  $this->service->listVendorProduct();
        return view('Vendor.list_vendorproduct', ["vendordetails"=> $vendordetails]);
    }
    
}
