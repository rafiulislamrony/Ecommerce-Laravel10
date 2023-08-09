<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    //
    public function addWishlist($id)
    {
        $userid = Auth::id();
        $check = DB::table('wishlists')->where('user_id', $userid)->where('product_id', $id)->first();

        $data = array(
            'user_id' => $userid,
            'product_id' => $id,
        );

        if (Auth::Check()) {
            if ($check) {
                return response()->json(['error' => 'Already Added on Wishlist.']);
            } else {
                DB::table('wishlists')->insert($data);
                return response()->json(['success' => 'Product Added on Wishlist.']);
            }
        } else {
            return response()->json(['error' => 'Please Login First.']);
        }
    }


    public function addToCart($id)
    {
        $cart = Session::get('cart');

        if (strpos($id, ',,,') == true) {
            $data = explode(',,,', $id);
            $id = $data[0];
            $qty = $data[1];

            $product = DB::table('products')->where('id', $id)->first();

            if(!empty($cart) && array_key_exists($id, $cart)){
                if($product->product_quantity < $cart[$id]['qty'] + $qty){
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            }else{
                if($product->product_quantity < $qty){
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
                $cart[$id]['qty'] +=  $qty;
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
            if(!empty($cart) && array_key_exists($id, $cart)){
                if($product->product_quantity < $cart[$id]['qty'] + 1){
                    return response()->json(['error' => 'Product Out of Stock']);
                }
            }else{
                if($product->product_quantity < 1){
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


}
