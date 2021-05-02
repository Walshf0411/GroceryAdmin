<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\DeliveryBoyService;
use Illuminate\Support\Facades\Validator;

class DeliveryBoyController extends Controller
{
    //
    public function __construct(DeliveryBoyService $vendorLoginService){
        $this->vendorLoginService = $vendorLoginService;
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'phoneno' => 'required|max:10',
            'password' => 'required',
          ]);

        if($validator->fails()){
            return response()->json(["message"=>"Enter all details"],400);
        }else{
            return $this->vendorLoginService->login($request);

        }
    }
}
