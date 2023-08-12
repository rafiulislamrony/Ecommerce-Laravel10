<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function addCart($id)
    {
        $cart = Session::get('cart');

        if (strpos($id, ',,,') == true) {
            $data = explode(',,,', $id);
            $id = $data[0];
            $qty = $data[1];

            $product = DB::table('products')->where('id', $id)->first();

            if (!empty($cart) && array_key_exists($id, $cart)) {
                if ($product->product_quantity < $cart[$id]['qty'] + $qty) {
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            } else {
                if ($product->product_quantity < $qty) {
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            }

            if (!$product) {
                abort(404);
            }

            $cart = Session::get('cart');

            // if cart is empty then this the first product
            if (!$cart) {
                $cart = [
                    $id => [
                        "id" => $product->id,
                        "title" => $product->product_name,
                        "qty" => $qty,
                        "price" => $product->selling_price,
                        "image" => $product->image_one
                    ]
                ];

                Session::put('cart', $cart);
                return response()->json(['message' => 'Product added to cart successfully!']);
            }

            // if cart not empty then check if this product exist then increment quantity
            if (isset($cart[$id])) {
                $cart[$id]['qty'] += $qty;
                Session::put('cart', $cart);
                return response()->json(['message' => 'Product added to cart successfully!']);
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "id" => $product->id,
                "title" => $product->product_name,
                "qty" => $qty,
                "price" => $product->selling_price,
                "image" => $product->image_one
            ];
        } else {

            $id = $id;
            $product = DB::table('products')->where('id', $id)->first();
            if (!$product) {
                abort(404);
            }
            if (!empty($cart) && array_key_exists($id, $cart)) {
                if ($product->product_quantity < $cart[$id]['qty'] + 1) {
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            } else {
                if ($product->product_quantity < 1) {
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            }

            $cart = Session::get('cart');
            // if cart is empty then this the first product
            if (!$cart) {

                $cart = [
                    $id => [
                        "id" => $product->id,
                        "title" => $product->product_name,
                        "qty" => 1,
                        "price" => $product->selling_price,
                        "image" => $product->image_one
                    ]
                ];

                Session::put('cart', $cart);
                return response()->json(['message' => 'Product added to cart successfully!']);
            }

            // if cart not empty then check if this product exist then increment quantity
            if (isset($cart[$id])) {
                $cart[$id]['qty']++;
                Session::put('cart', $cart);
                return response()->json(['message' => 'Product added to cart successfully!']);
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "id" => $product->id,
                "title" => $product->product_name,
                "qty" => 1,
                "price" => $product->selling_price,
                "image" => $product->image_one
            ];
        }

        Session::put('cart', $cart);
        return response()->json(['message' => 'Product added to cart successfully!']);
    }

    public function AddToCart($id)
    {
        $cart = Session::get('cart', []);

        $product = DB::table('products')->where('id', $id)->first();

        if ($product) {
            $cartItem = [
                "id" => $product->id,
                "name" => $product->product_name,
                "qty" => 1,
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


    public function check()
    {
        $content = Session::get('cart');
        return response()->json($content);
    }


}
