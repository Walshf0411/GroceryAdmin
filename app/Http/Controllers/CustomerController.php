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

    public function listCustomer()
    {
        $customerdetails = $this->service->listCustomer();
        return view('Customer.list_customer', ["customerdetails"=> $customerdetails]);
    }

    public function getCustomer($id)
    {
        $customer =  $this->service->getCustomerById($id);
        return view('Order.show_ordercustomer', ['customer'=> $customer]);

    }
}
