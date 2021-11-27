<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\SubCategoryService;

class CategoryApiController extends Controller
{
    public function __construct(SubCategoryService $subCategoryService){
        $this->subCategoryService = $subCategoryService;
    }

    public function list_product_subcategory($category_id){

        return response()->json(["products"=>$this->subCategoryService->list_product_by_subcategory($subcategory_id)], 200);
    }

}
