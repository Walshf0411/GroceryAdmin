<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\Product2Service;
use App\Service\CategoryService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller {
    
    public function __construct(Product2Service $productService, CategoryService $categoryService){
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            'term' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        Log::info("Starting search on products & categories with search term '".$request->term."'");
        $searchStartTime = microtime(true);

        $searchedProducts = $this->productService->searchProducts($request->term);
        $searchedCategories = $this->categoryService->searchCategories($request->term);

        $searchEndTime = microtime(true);
        $searchTime = round($searchEndTime - $searchStartTime, 2);

        Log::info("Search completed in ${searchTime}s");

        return response()->json([
            "time" => $searchTime."s",
            "products" => [
                "count" => count($searchedProducts),
                "list" => $searchedProducts
            ],
            "categories" => [
                "count" => count($searchedCategories),
                "list" => $searchedCategories
            ]
        ]);
    }
}