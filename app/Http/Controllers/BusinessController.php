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
    public function listView($id)
    {
        $vendordetails =  $this->service->show_product($id);
        return view('Vendor.show_product', ['vendordetails'=> $vendordetails[0], 'vendorprofiledetails'=> $vendordetails[1]]);
    }
}
