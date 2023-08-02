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
      return view('admin.product.create');
    }

}
