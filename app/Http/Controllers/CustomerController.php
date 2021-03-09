<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CustomerService;
use App\Service\AddressService;
use App\Service\OrderService;
class CustomerController extends Controller
{

    public function __construct(CustomerService $service,AddressService $addressService,OrderService $orderService){
        $this->service = $service;
        $this->addressService = $addressService;
        $this->orderService = $orderService;
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

    public function getCustomerProfile($id)
    {
        $address =  $this->addressService->listAddress($id);
        $orders =  $this->orderService->getOrdersByCustomer($id);
        return view('Customer.list_customerprofile', ['address'=> $address ,'orders' => $orders]);
    }
}
