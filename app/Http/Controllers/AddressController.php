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

    public function showOrderAddres($address_id)
    {
        $orderaddress =  $this->service->getOrderAddress($address_id);
        return view('Order.show_orderaddress', ['orderaddress'=> $orderaddress]);

    }
}
