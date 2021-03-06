<?php

namespace App\Http\Controllers;

use App\Model\Vendor;
use Illuminate\Http\Request;
use App\Service\VendorService;

class VendorController extends Controller
{
    //
    public function __construct(VendorService $service){
        $this->service = $service;
        $this->middleware('auth');
    }

    public function show()
    {
        $vendordetails = $this->service->listVendor();
        return view('Vendor.list_vendor', ["vendordetails"=> $vendordetails]);
    }

    public function listView($id)
    {
        $vendor =  $this->service->getVendorById($id);
        $vendorprofile =  $this->service->getProductbyVendor($id);
        return view('Vendor.list_vendorprofile', ['vendor'=> $vendor ,'vendorprofile' => $vendorprofile]);
    }

    public function showOrderVendor($id)
    {
        $vendordetails = $this->service->getVendorById($id);
        return view('Order.show_ordervendor', ["vendordetails"=> $vendordetails]);
    }

    public function show_block_vendor()
    {
        $vendordetails = $this->service->list_block_vendor();
        return view('Vendor.list_blocked_vendor', ["vendordetails"=> $vendordetails]);
    }

    public function update_block_vendor($id){
        $this->service->block_Vendor($id);
        return redirect()->route('list_vendor');
    }

    public function update_unblock_vendor($id){
        $this->service->unblock_Vendor($id);
        return redirect()->route('list_blocked_vendor');
    }

    public function destroy($id){
        $this->service->delete_block_Vendor($id);
        return redirect()->route('list_vendor');
    }

    public function destroy_blockedVendor($id){
        $this->service->delete_block_vendor($id);
        return redirect()->route('list_blocked_vendor');
    }
}
