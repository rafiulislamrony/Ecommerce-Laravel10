<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(){
       $product =  DB::table('products')->get();
    }
    public function create(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
      return view('admin.product.create', compact('category','brand'));
    }

    public function GetSubcat($category_id){
        $cat = DB::table('subcategories')->where('category_id', $category_id)->get();
        return json_encode($cat);
    }

    public function storeProduct(Request $request){

        $data['product_name']     = $request->product_name;
        $data['product_code']     = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id']      = $request->category_id;
        $data['subcategory_id']   = $request->subcategory_id;
        $data['brand_id']         = $request->brand_id;
        $data['product_size']     = $request->product_size;
        $data['product_color']    = $request->product_color;
        $data['selling_price']    = $request->selling_price;
        $data['product_details']  = $request->product_details;
        $data['video_link']       = $request->video_link;

        $data['main_slider']      = $request->main_slider;
        $data['hot_deal']         = $request->hot_deal;
        $data['bast_rated']       = $request->bast_rated;
        $data['trend']            = $request->trend;
        $data['mid_slider']       = $request->mid_slider;
        $data['hot_new']          = $request->hot_new;
        $data['status']           = 1;

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        return response()->json($data);

    }

}
