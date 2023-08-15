<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
