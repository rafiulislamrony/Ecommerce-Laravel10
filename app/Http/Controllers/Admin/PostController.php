<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

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
            'category_id' => 'required',
            'post_title_en' => 'required',
            'post_title_hin' => 'required',
            'details_en' => 'required',
            'details_hin' => 'required'
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_hin'] = $request->post_title_hin;
        $data['details_en'] = $request->details_en;
        $data['details_hin'] = $request->details_hin;

        $post_image = $request->file('post_image');

        if ($post_image) {
            $image_name = hexdec(uniqid()) . '.' . $post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400, 200)->save('media/blog/' . $image_name);
            $data['post_image'] = 'media/blog/' . $image_name;

            DB::table('posts')->insert($data);

            $notification = [
                'message' => 'Blog Inserted Successfully.',
                'alert-type' => 'success',
            ];
            return Redirect()->back()->with($notification);
        }else{
            $data['post_image'] = '';
            DB::table('posts')->insert($data);
            $notification = [
                'message' => 'Blog Inserted without Image.',
                'alert-type' => 'success',
            ];
            return Redirect()->back()->with($notification);
        }
    }

}
