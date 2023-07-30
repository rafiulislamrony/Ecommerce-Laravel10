<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category(){
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }
    
    public function storeCategory(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);

        // $data = array();
        // $data['category_name']= $request->category_name;
        // DB::table('categories')->insert($data);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        $notification = [
            'message' => 'Category Added Successfully',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }


}
