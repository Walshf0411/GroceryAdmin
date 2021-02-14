<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\TempProduct2Service;

class TempProduct2Controller extends Controller
{
    //
    public function __construct(TempProduct2Service $service){
        $this->service = $service;
        // $this->middleware('auth');
    }

    public function show(){
        $tempProducts= $this->service->listTempProduct();
        return view('TempProduct.listTempProduct',["tempProducts"=>$tempProducts]);
    }

    public function store(Request $request,$id){
        $this->service->approveTempProduct( $id);
        return $this->destroy($id);
    }

    public function destroy($id){
        $this->service->rejectedTempProduct($id);
        return redirect()->route("listTempProduct");
    }


}
