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

    public function edit($id, Request $request)
    {   
        $validator = Validator::make($request->all(), [
        'name' => 'string',
        'shop_name' => 'string',
        'address' => 'string',
        'gst_number' => 'string',
        'nickname' => 'string'
      ]);

        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->getMessages()],400);
        }else{
            return $this->service->editTempVendor($id, $request);
        }
    }

    public function getAddedProducts($id){
        return response()->json(["products"=>$this->service->show_product($id)['0']], 200);
    }
    public function vendorStats($id, Request $request){
        $request->validate([
            'fDate' => 'required',
            'tDate' => 'required',
            ]);
        $vendorStats = $this->service->vendorStats($id, $request->all()); 

        return response()->json([
            "status" => "Success",
            "message" => "Vendor Stats retrived successfully.",
            "details" => $vendorStats
        ]);
    }
}
