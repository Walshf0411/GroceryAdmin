<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\SubCategoryService;

class SubCategoryApiController extends Controller
{
    public function __construct(SubCategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function list_product_subcategory($category_id){

        return response()->json(["products"=>$this->categoryService->list_product_by_subcategory($category_id)], 200);
    }

}
