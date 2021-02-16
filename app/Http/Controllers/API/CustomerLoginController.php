<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\CustomerLoginService;
use Illuminate\Http\Request;

class CustomerLoginController extends Controller
{
    public function __construct(CustomerLoginService $customerLoginService){
        $this->customerLoginService = $customerLoginService;
    }

    public function login(Request $request){
        return $this->customerLoginService->login($request);
    }

    public function unauthorized(){
        return response()->json(["error"=>"login karo bhai"], 401);
    }
    public function checkToken(Request $request){
        return $this->customerLoginService->checkToken($request);
    }
    public function insertCustomer(Request $request){
        $response = $this->customerLoginService->insertCustomer($request);
        return response()->json(['token'=>$response[0], 'customer'=> $response[1],'message'=>'success'], 200);
    }

    public function editCustomer(Request $request,$id){
        $response = $this->customerLoginService->editCustomer($request,$id);
        return response()->json(['token'=>$response[0], 'customer'=> $response[1],'message'=>'success'], 200);

    }
}
