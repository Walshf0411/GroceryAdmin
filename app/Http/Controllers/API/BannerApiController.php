<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\ApiService;
use App\Service\BannerService;
use App\Service\CategoryService;
use App\Service\ProductService;

class BannerApiController
{
    public function __construct(BannerService $bannerService,CategoryService $categoryService, ProductService $productService){
        $this->bannerService = $bannerService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function show()
    {
        return response()->json(["banners"=>$this->bannerService->listBanner(), "categories"=>$this->categoryService->listCategory(), "products_list"=>$this->productService->productsWithDetials()]);
    }

    public function showCategory()
    {
        return response()->json(["categories"=>$this->categoryService->listCategory()]);

    }

}
