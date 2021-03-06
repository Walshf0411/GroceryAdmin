<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CustomerService;

class CustomerController extends Controller
{

    public function __construct(CustomerService $service){
        $this->service = $service;
        $this->middleware('auth');
    }

    public function show()
    {
        $customerdetails = $this->service->listVendor();
        return view('Customer.list_customer', ["customerdetails"=> $customerdetails]);
    }

    public function showOrderCustomer($id)
    {
        $customer =  $this->service->getCustomerById($id);
        return view('Order.show_ordercustomer', ['customer'=> $customer]);

    }
}
