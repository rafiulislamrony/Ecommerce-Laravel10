<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    //
    public function Blog(){
       $post = DB::table('posts')
        ->join('post_category', 'posts.category_id', 'post_category.id')
        ->select('posts.*', 'post_category.category_name_en', 'post_category.category_name_hin')
        ->get();
        return view('pages.blog', compact('post'));
    }
    public function BlogEnglish(){
        Session::get('lang');
        Session::forget('lang');
        Session::put('lang', 'english');
        return redirect()->back();
    }
    public function BlogHindi(){
        Session::get('lang');
        Session::forget('lang');
        Session::put('lang', 'hindi');
        return redirect()->back();
    }

    public function BlogSingle($id){
        $post = DB::table('posts')
        ->where('id',$id)
        ->get();
        return view('pages.blog_single', compact('post'));
    }
}
