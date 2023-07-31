<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;

class BrandController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function brand(){
        $brand = Brand::all();
        return view('admin.category.brand', compact('brand'));
    }
    public function storeBrand(){
        $brand = Brand::all();
        return view('admin.category.brand', compact('brand'));
    }

}
