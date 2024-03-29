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
        $this->middleware('auth');
    }


    public function viewAddBanner(){
        return view('Banner.add_banner');
    }

    public function viewListBanner(){
        $banner = $this->service->listBanner();
        return view('Banner.list_banner', ['banners'=>$banner]);
    }

    public function store(Request $request)
    {
        $this->service->insertBanner($request);
        return redirect()->route("list_banner")->with("success","Banner inserted successfully");
    }

    public function edit(Banner $banner, $id)
    {
        $banner = $this->service->editBanner($id);
        return view('Banner.edit_banner', ['banners'=> $banner]);
    }

    public function update(Request $request, Banner $banner, $id)
    {
        $this->service->updateBanner($request,$id);
        return redirect()->route('list_banner')->with("success","Banner updated successfully");
    }

    public function destroy(Banner $banner,$id)
    {
        $this->service->deleteBanner($id);
        return redirect()->back()->with("success","Banner deleted successfully");
    }

    public function getAllBanner(){
        $banners = Banner::get()->toJson(JSON_PRETTY_PRINT);
        return response($banners, 200);
    }
}
