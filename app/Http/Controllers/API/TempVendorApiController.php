<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\VendorApiService;
use App\Service\VendorLoginService;
use App\Service\TempVendorService;
use Illuminate\Support\Facades\Validator;
use  Illuminate\Support\Facades\Hash;
class TempVendorApiController extends Controller
{
    //

    public function __construct(TempVendorService $service){
        $this->service = $service;
        // $this->middleware('auth:vendor');
    }

    public function create(Request $request)
    {   $validator = Validator::make($request->all(), [
        'name' => 'required',
        'shop_name' => 'required',
        'address' => 'required',
        'email_id' => 'required|email',
        'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'mobile_number' => 'required|digits:10',
        'gst_number' => 'required',
        'message' => 'string',
        'nickname' => 'string'
      ]);

        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->getMessages()],400);
        }else{
            return $this->service->create_temp_vendor($request);
        }
    }

}
