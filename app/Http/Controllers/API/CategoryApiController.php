<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\CategoryService;

class CategoryApiController extends Controller
{
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function list_product_category($category_id){

        return response()->json($this->categoryService->list_product_by_category($category_id), 200);
    }

}
