<?php

namespace App\Http\Controllers;


use App\Model\TempVendor;
use Illuminate\Http\Request;
use App\Service\TempVendorService;


class TempVendorController extends Controller
{
    //
    public function __construct(TempVendorService $service){
        $this->service = $service;
    }


    public function show()
    {
        $tempvendors = $this->service->listVendor();
        return view('TempVendor.listtemp_vendor', ["tempvendors"=> $tempvendors]);
    }
    public function store($id)
    {
        $this->service->addVendor($id);
        return $this->destroy($id);
    }

    public function destroy($id)
    {
        $this->service->deleteVendor($id);
        return redirect()->route("list_temp_vendor");
    }
}
