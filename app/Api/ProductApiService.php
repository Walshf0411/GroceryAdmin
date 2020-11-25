<?php

namespace App\Api;
// namespace App\Http\Controllers;
use App\Model\TempProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductApiService
{
    public function create_temp_product(Request $request)
    {
           $tempvendor = new TempProduct;
           $tempvendor->name = $request->name;
           $tempvendor->shop_name = $request->shop_name;
           $tempvendor->address = $request->address;
           $tempvendor->email_id = $request->email_id;
           $tempvendor->mobile_number = $request->mobile_number;
           $tempvendor->gst_number = $request->gst_number;
           $tempvendor->message = $request->message;
           $tempvendor->save();

        //    return response()->json(["message" => "student record created"], 201);
            return response()->json($tempvendor);

    }

}
