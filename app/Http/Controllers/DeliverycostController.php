<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Delivery_cost;
use App\Service\DeliveryService;


class DeliverycostController extends Controller
{

    //
    public function __construct(DeliveryService $service){
        $this->service = $service;
        $this->middleware('auth');
    }
    public function viewAddDeliveryCost(){
        return view('DeliveryCost.add_deliverycost');
    }

    public function listDeliveryCost(){
        $delivery_cost = $this->service->listDeliveryCost();
        return view('DeliveryCost.list_deliverycost', ['delivery_cost'=>$delivery_cost]);
    }

    public function store(Request $request)
    {
        if($this->service->insertDeliveryCost($request)=='error'){
            return redirect()->route('list_deliverycost')->with("error","Data Already Exists");
        }else{
            return redirect()->route('list_deliverycost')->with("success","Data inserted successfully");
        }
    }

    public function edit()
    {
        $delivery_cost =  $this->service->editDeliveryCost();
        return view('DeliveryCost.edit_deliverycost', ['delivery_cost'=>$delivery_cost]);
    }

    public function update(Request $request)
    {
        $this->service->updateDeliveryCost($request);
        return redirect()->route('list_deliverycost')->with("success","Data updated successfully");
    }

    public function destroy()
    {
        $this->service->deleteDeliveryCost();
        return redirect()->back()->with("success","Data deleted successfully");
    }
}


