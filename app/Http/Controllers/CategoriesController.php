<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct(CategoryService $service){
        $this->service = $service;
    }

    public function viewAddCategory(){
        return view('Category.add_category');
    }
    public function listCategory(){
        $category = $this->service->listCategory();
        return view('Category.list_category', ['category'=>$category]);
    }

    public function store(Request $request)
    {
        $this->service->insertCategory($request);
        return redirect()->route('list_category')->with("Success","Data inserted Successfully");
    }

    public function edit(Category $category,$id)
    {
        $category =  $this->service->editCategory($id);
        return view('Category.edit_category', ['category'=> $category]);
    }

    public function update(Request $request, Category $category, $id)
    {
        $this->service->updateCategory($request,$id);
        return redirect()->route('list_category')->with("Success","Data deleted Successfully");;
    }

    public function destroy(Category $category, $id)
    {
        $this->service->deleteCategory($id);
        return redirect()->back()->with("Success","Data deleted Successfully");
    }
}
