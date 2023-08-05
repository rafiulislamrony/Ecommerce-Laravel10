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

    public function DeleteBlogCat($id){
        DB::table('post_category')->where('id',$id)->delete();
        $notification = [
            'message' => 'Blog Category Delete Successfully',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }

    public function EditBlogCat($id){
       $blogcatedit =  DB::table('post_category')->where('id',$id)->first();
       return view('admin.blog.category.edit', compact('blogcatedit'));
    }
    public function UpdateBlogCat(Request $request, $id){
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_hin'] = $request->category_name_hin;

        DB::table('post_category')->where('id',$id)->update($data);

        $notification = [
            'message' => 'Blog Category Update Successfully',
            'alert-type' => 'success',
        ];
        return Redirect()->route('add.blog.category')->with($notification);
    }


    public function AddBlog(){
        $blogCategory = DB::table('post_category')->get();
        return view('admin.blog.create', compact('blogCategory'));
    }
    public function StoreBlog(Request $request)
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
