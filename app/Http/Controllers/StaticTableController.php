<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\StaticTableService;


class StaticTableController extends Controller
{
    //
    public function __construct(StaticTableService $service){
        $this->service = $service;
        // $this->middleware('auth');
    }

    public function viewTc(){
        return view('StaticPages.tc',["content" => $this->service->getTc()] );
    }
    public function viewShare(){
        return view('StaticPages.share',["content" => $this->service->getShare()] );
    }
    public function viewAbout(){
        return view('StaticPages.aboutus',["content" => $this->service->getAboutUs()] );
    }
    public function viewContact() {
        return view('StaticPages.contact',["content" => $this->service->getContact()] );
    }
    
    public function addTc(Request $request){
        $this->service->addTc($request);
        return $this->viewTc();
    }
    public function addShare(Request $request){
        $this->service->addShare($request);
        return $this->viewShare();
    }
    public function addAboutUs(Request $request){
        $this->service->addAboutUs($request);
        return $this->viewAbout();
    }
    public function addContact(Request $request){
        $this->service->addContact($request);
        return $this->viewContact();
    }
}
