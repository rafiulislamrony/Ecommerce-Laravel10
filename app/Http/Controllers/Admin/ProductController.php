<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Unique;
use Image;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index()
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name', 'subcategories.subcategory_name')
            ->get();

        return view('admin.product.index', compact('product'));

    }
    public function create()
    {
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        return view('admin.product.create', compact('category', 'brand'));
    }

    public function GetSubcat($category_id)
    {
        $cat = DB::table('subcategories')->where('category_id', $category_id)->get();
        return json_encode($cat);
    }

    public function storeProduct(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;

        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['bast_rated'] = $request->bast_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['status'] = 1;

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        // return response()->json($data);
        if ($image_one && $image_two && $image_three) {

            $image_one_name = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300, 300)->save('media/product/' . $image_one_name);
            $data['image_one'] = 'media/product/' . $image_one_name;

            $image_two_name = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300, 300)->save('media/product/' . $image_two_name);
            $data['image_two'] = 'media/product/' . $image_two_name;

            $image_three_name = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300, 300)->save('media/product/' . $image_three_name);
            $data['image_three'] = 'media/product/' . $image_three_name;

            DB::table('products')->insert($data);

            $notification = [
                'message' => 'Product Inserted Successfully.',
                'alert-type' => 'success',
            ];
            return Redirect()->back()->with($notification);
        }

    }

    public function inactiveProduct($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 0]);

        $notification = [
            'message' => 'Product Inactive Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }

    public function activeProduct($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 1]);

        $notification = [
            'message' => 'Product Active Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }

    public function deleteProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        $image1 = $product->image_one;
        $image2 = $product->image_two;
        $image3 = $product->image_three;

        unlink($image1);
        unlink($image2);
        unlink($image3);

        DB::table('products')->where('id', $id)->delete();

        $notification = [
            'message' => 'Product Delete Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }

    public function viewProduct($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name', 'subcategories.subcategory_name')
            ->where('products.id', $id)
            ->first();

         return view('admin.product.show', compact('product'));

    }

    public function editProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $brand = DB::table('brands')->get();
        return view('admin.product.edit', compact('product', 'category', 'subcategory', 'brand'));
    }

    public function updateProduct(Request $request, $id)
    {

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;

        $data['video_link'] = $request->video_link;
        $data['discount_price'] = $request->discount_price;

        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['bast_rated'] = $request->bast_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['status'] = 1;

        $update = DB::table('products')->where('id', $id)->update($data);

        if ($update) {
            $notification = [
                'message' => 'Product Data Updated Successfully.',
                'alert-type' => 'success',
            ];
            return Redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'Nothid To Update.',
                'alert-type' => 'success',
            ];
            return Redirect()->route('all.product')->with($notification);
        }
    }
    public function updateProductimage(Request $request, $id)
    {
        $oldone = $request->old_one;
        $oldtwo = $request->old_two;
        $oldthree = $request->old_three;

        $data = array();
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if ($image_one) {
            unlink($oldone);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path . $image_full_name;
            $image_one->move($upload_path, $image_full_name);
            $data['image_one'] = $image_url;
            DB::table('products')->where('id', $id)->update($data);
            $notification = [
                'message' => 'Image One Updated Successfully',
                'alert-type' => 'success',
            ];
            return Redirect()->route('all.product')->with($notification);
        }

        if ($image_two) {
            unlink($oldtwo);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_two->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path . $image_full_name;
            $image_two->move($upload_path, $image_full_name);
            $data['image_two'] = $image_url;
            DB::table('products')->where('id', $id)->update($data);
            $notification = [
                'message' => 'Image Two Updated Successfully',
                'alert-type' => 'success',
            ];
            return Redirect()->route('all.product')->with($notification);
        }

        if ($image_three) {
            unlink($oldthree);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_three->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path . $image_full_name;
            $image_three->move($upload_path, $image_full_name);
            $data['image_three'] = $image_url;
            DB::table('products')->where('id', $id)->update($data);
            $notification = [
                'message' => 'Image three Updated Successfully',
                'alert-type' => 'success',
            ];
            return Redirect()->route('all.product')->with($notification);
        }
    }

    public function ProductsView($id){
        $products = DB::table('products')->where('subcategory_id', $id)->paginate(10);
        return view('pages.all_product', compact('products'));
    }


}
