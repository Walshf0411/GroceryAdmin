<?php

namespace App\Service;
// namespace App\Http\Controllers;
use App\Model\Timeslot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TimeslotService{

    public function insertTimeslot(Request $request){
        $timeslots = new Timeslot;
        $timeslots->timeslot = $request->timeslot;
        $timeslots->save();

    }

    public function editTimeslot($id){
        $timeslots = DB::select('select * from timeslots where id = ?', [$id]);
        if($timeslots==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        return $timeslots;
    }

    public function updateTimeslot(Request $request,$id){
        $timeslots = DB::select('select * from timeslots where id = ?', [$id]);
        if($timeslots==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }else{
            $timeslots = DB::update('update timeslots set timeslot = ? where id = ?', [ $request->timeslot,$id]);
        }
    }


    public function deleteTimeslot($id){
        $timeslots = Timeslot::findOrFail($id)->delete();
        return response()->json(["message" => "Data deleted Successfully"]);
    }


    public function listTimeslot(){
        $timeslots = DB::select('select * from timeslots');
        return $timeslots;
    }
}
