<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = DB::select('select count(*) c from categories');
        $banner = DB::select('select count(*) c from banners');
        $vendors = DB::select('select count(*) c from vendors where is_blocked = 0');
        $bvendors = DB::select('select count(*) c from vendors where is_blocked = 1');
        $customers = DB::select('select count(*) c from customers');
        $products = DB::select('select count(*) c from products');
        // dd($vendors['0']->c);
        return view('dashboard',["category"=>$category['0']->c,
        "banner"=> $banner['0']->c,
        "vendors" => $vendors['0']->c,
        "bvendors" => $bvendors['0']->c,
        "customers"=> $customers['0']->c,
        "products"=> $products['0']->c]);
    }
}
