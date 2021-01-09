<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Service\ProductService;

class ProductController extends Controller
{
    public function __construct(ProductService $service){
        $this->service = $service;
        $this->middleware('auth');
    }

    public function index()
    {
        $category = $this->service->viewAddProduct();
        return view('Product.add_product', ["category"=> $category]);
    }

    public function store(Request $request)
    {
        $this->service->storeProduct($request);
        return redirect()->route("list_product")->with("message","data inserted successfully");
    }

    public function show(Product $product)
    {
        $products = $this->service->listProduct();
        return view('Product.list_product', ["products"=> $products]);

    }

    public function edit(Product $product,$id)
    {
        $product= $this->service->editProduct($id);
        return view('Product.edit_product', ['product'=> $product[0], 'category'=> $product[1]]);
    }

    public function update(Request $request, Product $product, $id)
    {
        $this->service->updateProject($request, $id);
        return redirect()->route('list_product')->with("Success","Data Edited Successfully");
    }


    public function destroy(Product $product, $id)
    {
        $this->service->delete_product($id);
        return redirect()->back()->with("message","data deleted successfully");
    }
}
