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
        return $this->service->listProduct();
    }

    public function store(Request $request, $id)
    {
        return $this->service->addProduct($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->deleteProduct($id);
    }
}
