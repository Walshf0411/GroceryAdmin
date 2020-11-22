<?php

namespace App\Api;
// namespace App\Http\Controllers;
use App\Model\Banner;
use App\Model\Category;
use Illuminate\Http\Request;


class ApiService
{

    public function getAllBanner(){
        $banners['banners'] = Banner::all();
        $categories['category'] = Category::all();
        return response()->json(array_merge($banners, $categories));
    }


}
