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
        return $this->service->listVendorProduct();
    }
    public function edit($id)
    {
        return $this->service->show_product($id);
    }
}
