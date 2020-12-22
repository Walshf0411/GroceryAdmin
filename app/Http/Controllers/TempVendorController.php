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
        $tempvendors = $this->service->list_temp_Vendor();
        return view('TempVendor.listtemp_vendor', ["tempvendors"=> $tempvendors]);
    }
    public function store($id)
    {
        $this->service->add_temp_Vendor($id);
        return $this->destroy($id);
    }

    public function destroy($id)
    {
        $this->service->delete_temp_Vendor($id);
        return redirect()->route("list_temp_vendor");
    }
}
