<?php


namespace App\Http\Controllers;

use App\Model\SubCategory;
use App\Model\Category;
use App\Service\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    public function __construct(SubCategoryService $service){
        $this->service = $service;
        // $this->middleware('auth');
    }


    public function viewAddSubCategory(){
        return view('SubCategory.add_subcategory', ['category'=> Category::all()]);
    }
    public function listSubCategory(){
        $subcategory = $this->service->listSubCategory();
        return view('SubCategory.list_subcategory', ['subcategory'=>$subcategory]);
    }

    public function store(Request $request)
    {
        if($this->service->insertSubCategory($request)=='error'){
            return redirect()->back()->with("error","SubCategory Already Exists ");
        }else{
            return redirect()->route('list_subcategory')->with("success","SubCategory inserted successfully");
        }
    }

    public function edit(SubCategory $subcategory,$id)
    {
        $subcategory =  $this->service->editSubCategory($id);
        return view('SubCategory.edit_subcategory', ['subcategory'=> $subcategory, 'category'=> Category::all()]);
    }

    public function update(Request $request, SubCategory $subcategory, $id)
    {
        $this->service->updateSubCategory($request,$id);
        return redirect()->route('list_subcategory')->with("success","SubCategory updated successfully");
    }

    public function destroy(SubCategory $subcategory, $id)
    {
        $this->service->deleteSubCategory($id);
        return redirect()->back()->with("success","SubCategory deleted successfully");
    }
}
