<?php

namespace App\Http\Controllers;

use App\Model\Address;
use Illuminate\Http\Request;
use App\Service\AddressService;
class AddressController extends Controller
{

    public function __construct(AddressService $service){
        $this->service = $service;
        // $this->middleware('auth');
    }

    public function listAddress($customer_id){

        $address =  $this->service->listAddress($customer_id);
        return view('Address.list_address', ['address'=> $address]);
    }

    public function getAddress($id)
    {
        $address =  $this->service->getAddressById($id);
        return view('Order.show_orderaddress', ['address'=> $address]);
    }


}
