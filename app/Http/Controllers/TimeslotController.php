<?php

namespace App\Http\Controllers;


use App\Model\Timeslot;
use App\Service\TimeslotService;
use Illuminate\Http\Request;

class TimeslotController extends Controller
{
    //
    public function __construct(TimeslotService $service){
        $this->service = $service;
        $this->middleware('auth');
    }
    public function viewAddTimeslot(){
        return view('Timeslot.add_timeslot');
    }

    public function listTimeslots(){
        $timeslots = $this->service->listTimeslot();
        return view('Timeslot.list_timeslot', ['timeslots'=>$timeslots]);
    }

    public function store(Request $request)
    {
        $this->service->insertTimeslot($request);
        return redirect()->route('list_timeslot')->with("success","Data inserted successfully");
    }

    public function edit($id)
    {
        $timeslots =  $this->service->editTimeslot($id);
        return view('Timeslot.edit_timeslot', ['timeslots'=> $timeslots]);
    }

    public function update(Request $request,$id)
    {
        $this->service->updateTimeslot($request,$id);
        return redirect()->route('list_timeslot')->with("success","Data updated successfully");
    }

    public function destroy($id)
    {
        $this->service->deleteTimeslot($id);
        return redirect()->back()->with("success","Data deleted successfully");
    }
}
