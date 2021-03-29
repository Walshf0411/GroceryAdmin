<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\Product2Service;

class Product2Controller extends Controller
{

    public function __construct(Product2Service $service){
        $this->service = $service;
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

    public function getProduct($id)
    {
        $orderproducts =  $this->service->getOrderProduct($id);
        return view('Order.show_orderproduct', ['orderproducts'=> $orderproducts]);
    }

}
