<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StaticTableService{
    public function addTc(Request $request){
        $staticTable = DB::update('update statictable set content = ? where page = "terms"', [$request->tc]);
        return "Terms and Conditions Changes completed Successfully";
    }
    public function addShare(Request $request){
        $staticTable = DB::update('update statictable set content = ? where page = "share"', [$request->share]);
        return "Share App changes completed  Successfully";}

    public function addAboutus(Request $request){
        $staticTable = DB::update('update statictable set content = ? where page = "about"', [$request->aboutus]);
        return "About Us changes completed Successfully";
    }
    public function getTc(){
        return DB::select('select content from statictable where page = "terms"')['0']->content;
    }
    public function getShare(){
        return DB::select('select content from statictable where page = "share"')['0']->content;
    }
    public function getAboutUs(){
        return DB::select('select content from statictable where page = "about"')['0']->content;
    }
    public function getRpSecretKey(){
        return DB::select("select content from statictable where page='rpsecretkey'")['0']->content;
    }
}
