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
        $this->service->insertDeliveryCost($request);
        return redirect()->route('list_deliverycost')->with("Success","Data inserted Successfully");
    }

    public function edit()
    {
        $delivery_cost =  $this->service->editDeliveryCost();
        return view('DeliveryCost.edit_deliverycost', ['delivery_cost'=>$delivery_cost]);
    }

    public function update(Request $request)
    {
        $this->service->updateDeliveryCost($request);
        return redirect()->route('list_deliverycost')->with("Success","Data updated Successfully");
    }

    public function destroy()
    {
        $this->service->deleteDeliveryCost();
        return redirect()->back()->with("Success","Data deleted Successfully");
    }
}

