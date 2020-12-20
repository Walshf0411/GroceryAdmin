<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Service\VendorLoginService;
use Illuminate\Http\Request;

class VendorLoginController extends Controller
{
    public function __construct(VendorLoginService $vendorLoginService){
        $this->vendorLoginService = $vendorLoginService;
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email_id' => 'required|email|max:255',
            'password' => 'required',
          ]);

        if($validator->fails()){
            return response()->json(["Enter all details"],400);
        }else{
            return $this->vendorLoginService->login($request);

        }
    }

    public function unauthorized(){
        return response()->json(["error"=>"login karo bhai"], 401);
    }
    public function checkToken(Request $request){
        return $this->vendorLoginService->checkToken($request);
    }
}
