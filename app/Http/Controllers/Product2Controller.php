<?php

namespace App\Http\Controllers;

use App\Service\CategoryService;
use Illuminate\Http\Request;
use App\Service\Product2Service;

class Product2Controller extends Controller
{

    public function __construct(Product2Service $service, CategoryService $categoryService){
        $this->service = $service;
        $this->categoryService = $categoryService;
        // $this->middleware('auth');
    }

    public function index()
    {
        $category = $this->service->viewAllCategories();
        $vendors = $this->service->viewAllVendors();
        return view('Product.add_product', ["category"=> $category, "vendors"=>$vendors]);
    }

    public function show(){
        $products= $this->service->listProduct();
        return view('Product.listProduct',["products"=>$products]);
    }

    public function store(Request $request){
        $products = $this->service->insertProduct($request);
        return redirect()->route("listProduct")->with('success','Product inserted successfully');
    }

    public function destroy($id){
        $products = $this->service->deleteProduct($id);
        return redirect()->back()->with('success','Product deleted successfully');
    }

    public function listProduct($id){
        $productdescription = $this->service->getProductDetails($id);
        return view('Product.product_details',['productdescription'=>$productdescription]);
        // return redirect()->back()->with('success','Product deleted successfully');
    }

   
    public function edit($id){

        return view('Product.edit_product', ['product'=> $this->service->getProduct($id),
                     'category'=> $this->categoryService->listCategory()]);
    }
    public function update(Request $request, $id){
        return redirect()->route('listProduct')->with('success',$this->service->editProduct($request, $id));
    }
}
