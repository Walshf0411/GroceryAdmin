<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Service\AddressService;
use App\Http\Controllers\Controller;
class AddressApiController extends Controller
{
    //
    public function __construct(AddressService $addressService){
        $this->addressService = $addressService;

    }

    public function storeAddress(Request $request){
        // $this->addressService->insertAddress($request);
        return response()->json(["message" =>$this->addressService->insertAddress($request)],200);
    }

    public function destroyAddress($id){
        return response()->json(["message"=>$this->addressService->deleteAddress($id)], 200);
    }

    public function updateAddress(Request $request,$id){
        return response()->json(["message"=>$this->addressService->updateAddress($request,$id)], 200);
    }

    public function listAddress(){
        return response()->json(["address"=>$this->addressService->listAddress()], 200);
    }


}
