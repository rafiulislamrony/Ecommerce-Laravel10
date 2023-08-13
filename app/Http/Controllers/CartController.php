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
                return response()->json(['error' => 'Allready Added On Cart.']);
            } else {
                // Otherwise, add the new item to the cart
                $cart[$id] = $cartItem;
            }

            Session::put('cart', $cart);

            return response()->json(['success' => 'Product added to cart successfully!']);
        }

        return response()->json(['error' => 'Product not found.']);
    }

    public function ShowCart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = [];
        }
        return view('pages.cart', compact('cart'));
    }

    public function RemoveCart($id)
    {
        if ($id) {
            $cart = Session::get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);
                Session::put('cart', $cart);
            }
            $total = 0;
            $count = 0;
            $count = count($cart);
            foreach ($cart as $i) {
                $total += $i['price'] * $i['qty'];
            }
            $total = round($total, 2);

            return response()->json([
                'success' => 'Product removed successfully',
                'count' => $count,
                'total' => $total
            ]);
        }
    }

    public function UpdateCartQty(Request $request)
    {
        $id = $request->productId;
        $qty = $request->qty;

        if (Session::has('cart')) {
            $cart = Session::get('cart');

            $product = DB::table('products')->where('id', $id)->first();

            if ($product->product_quantity < $qty) {
                $notification = [
                    'message' => 'Stock not available',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }
            if (isset($cart[$id])) {
                $cart[$id]['qty'] = $qty;
                Session::put('cart', $cart);
                $notification = [
                    'message' => 'Quantity Updated.',
                    'alert-type' => 'success',
                ];
                return redirect()->back()->with($notification);
            }
        }
    }

    public function check()
    {
        $content = Session::get('cart');
        return response()->json($content);
    }




}
