<?php

namespace App\Service;

use App\Model\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
// use DB as DB;
use Illuminate\Support\Facades\DB;

class BannerService{

public function insertBanner(Request $request){
    $count = DB::select("select id from banners order by id DESC LIMIT 1");
    if(count($count)==0){
        $number = 1;
    }else{
        $number = $count['0']->id +1;
    }
        if($request->hasFile('banner_image')){
            $path =storage_path("app/public/images/Banner/");
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $image = $request->file('banner_image');
            $extension = $image->extension();
            $name =  $number.".".$extension;
            Image::make($image)->resize(100, 100)->save(storage_path('app/public/images/Banner/').$name);
        }

        $banner = new Banner;
        $banner->banner_image = $name;
        $banner->save();

    }

    public function listBanner(){
        return Banner::all();
    }

    public function deleteBanner($id){
        $banner = DB::select('select * from banners where id = ? limit 1', [$id]);
        if($banner==null){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        $image_path = storage_path('app/public/images/Banner/'.$banner[0]->banner_image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $banner = DB::delete('delete from banners where id = ?', [$id]);
    }


    public function editBanner($id){
        $banner = DB::select('select * from banners where id = ?', [$id]);

        if($banner==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        return $banner;
    }

    public function updateBanner(Request $request, $id){
        $banner = DB::select('select * from banners where id = ?', [$id]);
        if($banner==[]){
            return redirect()->back()->with("Error","Data Not Found ");
        }
        $image_path = storage_path('app/public/images/Banner/'.$banner[0]->banner_image);
        if (File::exists($image_path)) {
            File::delete($image_path);
            $image = $request->file('banner_image');
            $extension = $image->extension();
            $name =  $id.".".$extension;
            Image::make($image)->resize(100, 100)->save(storage_path('app/public/images/Banner/').$name);

            $banner = DB::update('update banners set banner_image = ? where id = ?', [$name, $id]);
        }

    }
}
