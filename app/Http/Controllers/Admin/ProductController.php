<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(){
       $product =  DB::table('products')->get();
    }
    public function create(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
      return view('admin.product.create', compact('category','brand'));
    }

    public function GetSubcat($category_id){
        $cat = DB::table('subcategories')->where('category_id', $category_id)->get();
        return json_encode($cat);
    }

}
