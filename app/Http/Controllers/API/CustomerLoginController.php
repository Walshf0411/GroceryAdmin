<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Service\CustomerLoginService;
use Illuminate\Http\Request;

class CustomerLoginController extends Controller
{
    public function __construct(CustomerLoginService $customerLoginService){
        $this->customerLoginService = $customerLoginService;
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email_id' => 'required|email|max:255',
            'password' => 'required',
          ]);

        if($validator->fails()){
            return response()->json(["message"=>"Enter all details"],400);
        }else{
            return $this->customerLoginService->login($request);
        }
    }

    public function unauthorized(){
        return response()->json(["error"=>"login karo bhai"], 401);
    }
    public function checkToken(Request $request){
        return $this->customerLoginService->checkToken($request);
    }
    public function insertCustomer(Request $request){
        $validator = Validator::make($request->all(), [
            'c_name' => 'required',
            'mobile_number' => 'required|digits:10',
            'email_id' => 'required|email',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
          ]);
          if($validator->fails()){
            return response()->json(["message"=>$validator->errors()->getMessages()],400);
        }else{

        $response = $this->customerLoginService->insertCustomer($request);
        return response()->json(['token'=>$response[0], 'customer'=> $response[1],'message'=>'success'], 200);
        }
    }

    public function editCustomer(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'c_name' => 'required',
            'email_id' => 'required|email',
            'mobile_number' => 'required|digits:10',
          ]);
          if($validator->fails()){
            return response()->json(["message"=>"Enter all details properly"],400);
        }else{
        $response = $this->customerLoginService->editCustomer($request,$id);
        return response()->json(['token'=>$response[0], 'customer'=> $response[1],'message'=>'success'], 200);
        }
    }
}
