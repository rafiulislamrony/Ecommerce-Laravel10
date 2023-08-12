<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{


    public function AddToCart($id)
    {
        $cart = Session::get('cart', []);

        $product = DB::table('products')->where('id', $id)->first();

        if ($product) {
            $cartItem = [
                "id" => $product->id,
                "name" => $product->product_name,
                "qty" => '1',
                "price" => ($product->discount_price === NULL) ? $product->selling_price : $product->discount_price,
                "weight" => 1,
                "color" => '',
                "size" => '',
                "image" => $product->image_one
            ];

            if (array_key_exists($id, $cart) && $product->product_quantity < $cart[$id]['qty']) {
                return response()->json(['error' => 'Product Out of Stock']);
            } elseif (array_key_exists($id, $cart)) {
                // If the item already exists in the cart, update the quantity
                $cart[$id]['qty']++;
                Session::put('cart', $cart);
                return response()->json(['success' => 'Product Quantity Updated successfully']);
            } else {
                // Otherwise, add the new item to the cart
                $cart[$id] = $cartItem;
            }

            Session::put('cart', $cart);

            return response()->json(['success' => 'Product added to cart successfully!']);
        }

        return response()->json(['error' => 'Product not found.']);
    }

    public function ShowCart(){
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = [];
        }
        return view('pages.cart', compact('cart'));
    } 

    public function check()
    {
        $content = Session::get('cart');
        return response()->json($content);
    }


}
