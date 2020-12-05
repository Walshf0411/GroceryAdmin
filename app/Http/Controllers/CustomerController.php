<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CustomerService;

class CustomerController extends Controller
{

    public function __construct(CustomerService $service){
        $this->service = $service;
    }

    public function show()
    {
        return $this->service->listVendor();
    }
}