<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\ApiService;
use App\Service\BannerService;
use App\Service\CategoryService;
use App\Service\Product2Service;

class BannerApiController
{
    public function __construct(BannerService $bannerService,CategoryService $categoryService, Product2Service $product2Service){
        $this->bannerService = $bannerService;
        $this->categoryService = $categoryService;
        $this->product2Service = $product2Service;
    }

    public function show()
    {
        return response()->json(["banners"=>$this->bannerService->listBanner(), "categories"=>$this->categoryService->listCategory(), "products"=>$this->product2Service->homeListProduct()]);
    }

    public function showCategory()
    {
        return response()->json(["categories"=>$this->categoryService->listCategory()]);

    }

}
