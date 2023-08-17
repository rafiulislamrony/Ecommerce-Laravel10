<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductDetailsController extends Controller
{
    //
    public function ProductDetsilsView($id, $product_name)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('products.id', $id)
            ->first();

        if ($product) {
            $color = $product->product_color;
            $product_color = $color !== null ? explode(',', $color) : [];

            $size = $product->product_size;
            $product_size = $size !== null ? explode(',', $size) : [];

            return view('pages.product_details', compact('product', 'product_color', 'product_size'));
        }
    }

    public function AddCart(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        $product = DB::table('products')->where('id', $id)->first();

        if ($product) {
            $cartItem = [
                "id" => $product->id,
                "name" => $product->product_name,
                "qty" => $request->qty,
                "price" => ($product->discount_price === NULL) ? $product->selling_price : $product->discount_price,
                "weight" => 1,
                "color" => $request->color,
                "size" => $request->size,
                "image" => $product->image_one
            ];


            if (array_key_exists($id, $cart) && $product->product_quantity < $cart[$id]['qty']) {

                $notification = [
                    'message' => 'Product Out of Stock',
                    'alert-type' => 'error',
                ];
                return Redirect()->back()->with($notification);
            } elseif (array_key_exists($id, $cart)) {
                // If the item already exists in the cart, update the quantity
                $cart[$id]['qty']++;
                Session::put('cart', $cart);
                $notification = [
                    'message' => 'Product Quantity Updated successfully',
                    'alert-type' => 'success',
                ];
                return Redirect()->back()->with($notification);
            } else {
                // Otherwise, add the new item to the cart
                $cart[$id] = $cartItem;
            }

            Session::put('cart', $cart);

            $notification = [
                'message' => 'Product added to cart successfully!',
                'alert-type' => 'success',
            ];
            return Redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'Product not found.',
            'alert-type' => 'error',
        ];
        return Redirect()->back()->with($notification);

    }

}
