<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AddBlogCat()
    {
        $blogCat = DB::table('post_category')->get();
        return view('admin.blog.category.index', compact('blogCat'));
    }
    public function StoreBlogCat(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_hin' => 'required|max:255'
        ]);
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_hin'] = $request->category_name_hin;
        DB::table('post_category')->insert($data);

        $notification = [
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }


}
