<?php


namespace App\Http\Controllers;

use App\Model\TempProduct;
use Illuminate\Http\Request;
use App\Service\TempProductService;

class TempProductController extends Controller
{
    //

    public function __construct(TempProductService $service){
        $this->service = $service;
    }


    public function show()
    {
        $tempproducts = $this->service->listProduct();
        return view('TempProduct.listtemp_product', ["tempproducts"=> $tempproducts]);
    }

    public function store(Request $request, $id)
    {
        $this->service->addProduct($request, $id);
        return $this->destroy($id);
    }

    public function destroy($id)
    {
         $this->service->deleteProduct($id);
        return redirect()->route("list_temp_product");
    }
}
