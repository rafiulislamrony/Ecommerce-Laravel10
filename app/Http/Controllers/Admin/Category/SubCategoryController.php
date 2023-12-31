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
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        return view('admin.category.subcategory', compact('category', 'subcat'));
    }

    public function storeSubcat(Request $request)
    {
        $validation = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->insert($data);

        $notification = [
            'message' => 'Subcategory Added Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);

    }


    public function deleteSubcategory($id)
    {
        DB::table('subcategories')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Subcategory Deleted Successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function editSubcategory($id)
    {
        $subcategory = DB::table('subcategories')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        return view('admin.category.edit_subcategory', compact('category', 'subcategory'));
    }

    public function updateSubcategory(Request $request, $id){
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->where('id', $id)->update($data);

        $notification = [
            'message' => 'Subcategory Updated Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->route('sub.category')->with($notification);
    }

}
