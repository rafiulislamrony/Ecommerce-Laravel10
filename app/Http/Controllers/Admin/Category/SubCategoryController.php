<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;
class SubCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subCategory()
    {
        $category = DB::table('categories')->get();
        $subcat = DB::table('subcategories')
        ->join('categories', 'subcategories.category_id', 'categories.id')
        ->select('subcategories.*','categories.category_name')
        ->get();
        return view('admin.category.subcategory', compact('category', 'subcat'));
    }

    public function storeSubcat(Request $request){

    }




}
