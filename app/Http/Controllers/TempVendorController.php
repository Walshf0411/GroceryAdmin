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
        // $this->middleware('auth');
    }


    public function show()
    {
        $tempvendors = $this->service->list_temp_Vendor();
        return view('TempVendor.listtemp_vendor', ["tempvendors"=> $tempvendors]);
    }
    public function store($id)
    {
        $this->service->add_temp_Vendor($id);
        return $this->destroy($id)->with('success','Temporary vendor inserted');
    }

    public function destroy($id)
    {
        $this->service->delete_temp_Vendor($id);
        return redirect()->route("list_temp_vendor")->with('success','Temporary vendor deleted');
    }
}
