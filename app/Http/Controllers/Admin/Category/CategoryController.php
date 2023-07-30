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

    public function deleteCategory($id){
        DB::table('categories')->where('id', $id)->delete();
        // Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'success' => 'info'
        );
        return redirect()->back()->with($notification);
    }
    public function editCategory($id){
        // $category = DB::table('categories')->where('id',$id)->first();
        $category = Category::findOrFail($id);
        return view('admin.category.edit_category', compact('category'));
    }

    public function updateCategory(Request $request){
        $cat_id = $request->id;
        $validated = $request->validate([
            'category_name' => 'required|max:255'
        ]);

        Category::findOrfail($cat_id)->update([
            'category_name' => $request->category_name,
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories')->with($notification);
    }




}
