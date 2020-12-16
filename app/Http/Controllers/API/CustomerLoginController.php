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
}