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
        $this->middleware('auth');
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
         $this->service->temp_delete_product($id);
        return redirect()->route("list_temp_product");
    }
}
