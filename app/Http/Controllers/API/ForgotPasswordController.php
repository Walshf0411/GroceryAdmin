<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\Customer;
use App\Model\DeliveryBoy;
use App\Model\Vendor;

class ForgotPasswordController extends Controller
{    
    public function updatePassword(Request $request, $userType) {
        $users = null;

        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|digits:10',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ]);
        if($validator->fails()){
            return response()->json([
                "message" => $validator->errors()->getMessages()
            ], 400);
        }
        $mobileNumber = $request->mobile_number;
        $newPassword = $request->password;

        if ( strcmp($userType, "vendor") == 0 ) {
            $users = Vendor::where("mobile_number", $mobileNumber)->get();
        } else if ( strcmp($userType, "customer") == 0 ) {
            $users = Customer::where("mobile_number", $mobileNumber)->get();
        }else if ( strcmp($userType, "deliveryboy") == 0 ) {
            $users = DeliveryBoy::where("phoneno", $mobileNumber)->get();
        } else {
            return response()->json(["message" => "Page not found"], 404);
        }
        if (!isset($users[0])) {
            return response()->json([
                "message" => "User with phone number does not exist"
            ], 400); 
        }
        $user = $users[0];
        $user->password = bcrypt($newPassword);
        $user->save();

        return response()->json([
            "message" => "Password updated successfully"
        ]);
    }
}