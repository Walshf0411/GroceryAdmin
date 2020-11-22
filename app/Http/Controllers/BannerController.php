<?php

namespace App\Http\Controllers;

use App\Model\Banner;
use Illuminate\Http\Request;
use App\Service\BannerService;
class BannerController extends Controller
{
    // BannerServices $service;

    public function __construct(BannerService $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function viewAddBanner(){
        return view('Banner.add_banner');
    }
    public function viewListBanner(){
        // dd('hi');
        return $this->service->listBanner();
    }
    // public function vieweditBanner($id){
    //     return view('Banner.edit_banner');
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return $this->service->insertBanner($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner, $id)
    {
        return $this->service->editBanner($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner, $id)
    {
        return $this->service->updateBanner($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner,$id)
    {
        //
        return $this->service->deleteBanner($id);
    }

    public function getAllBanner(){
        //
        // return response()->json($this->service->listBanner());
        $banners = Banner::get()->toJson(JSON_PRETTY_PRINT);
        return response($banners, 200);
    }
}
