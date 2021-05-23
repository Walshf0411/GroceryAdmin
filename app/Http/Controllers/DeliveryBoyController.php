<?php

namespace App\Http\Controllers;

use App\Model\DeliveryBoy;
use App\Model\Orders;
use Illuminate\Http\Request;
use App\Service\DeliveryBoyService;

class DeliveryBoyController extends Controller
{
    //

    public function __construct(DeliveryBoyService $service){
        $this->service = $service;
        $this->middleware('auth');
    }

    public function listDeliveryBoys(){return view("DeliveryBoy.listDeliveryboy", ["delivery" =>DeliveryBoy::all()]);}

    public function addDeliveryBoy(Request $request){return redirect()->back()->with("success", $this->service->addDelievryBoy($request));}

    public function viewAddDeliveryBoyPage(){return view("DeliveryBoy.addDeliveryBoy");}

    public function viewEditDeliveryBoyPage($id){return view("DeliveryBoy.editDeliveryBoy", ["delivery" =>DeliveryBoy::where('id', $id)->get()]);}

    public function editDeliveryBoy(Request $request, $id){ $this->service->editDeliveryBoy($request, $id); return  $this->listDeliveryBoys();}

    public function deleteDeliveryBoy($id){
        $this->service->deleteDeliveryBoy($id);
        return $this->listDeliveryBoys();
    }

    public function viewDeliveryBoy($id){
        return view('DeliveryBoy.viewDeliveryBoy', [
            "row"=>  $this->service->getRiderById($id),
            "orders"=> $this->service->getOrderByRiderId($id),
            "message" => $this->service->getDeliveryBoyAvailability($id)
        ]);
    }



}
