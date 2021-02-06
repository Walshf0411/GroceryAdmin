<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\VendorApiService;
use App\Service\VendorLoginService;
use App\Service\VendorService;
use Illuminate\Support\Facades\Validator;
use  Illuminate\Support\Facades\Hash;
class VendorApiController extends Controller
{
    //

    public function __construct(VendorService $service){
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
        'message' => 'required',
      ]);

        if($validator->fails()){
            return response()->json(["message"=>"Enter all details properly"],400);
        }else{
            return $this->service->create_temp_vendor($request);
        }
    }

    public function trial(){

        return "Welcome vendor";
    }
    public function getAddedProducts($id){
        return response()->json(["products"=>$this->service->show_product($id)['0']], 200);
    }
}
