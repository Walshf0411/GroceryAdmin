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

    public function store(Request $request){
        $this->addressService->insertAddress($request);
        return response()->json(["message" => "Data inserted Successfully"]);
    }

}
