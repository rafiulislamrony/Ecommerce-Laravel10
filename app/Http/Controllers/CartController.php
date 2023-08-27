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

    public function QuickView($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name', 'subcategories.subcategory_name')
            ->where('products.id', $id)
            ->first();


        $color = $product->product_color;
        $product_color = $color ? explode(',', $color) : [];

        $size = $product->product_size;
        $product_size = $size ? explode(',', $size) : [];


        return response()->json([
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ]);
    }


    public function AddQuickViewProduct(Request $request)
    {
        $id = $request->product_id;
        $color = $request->color;
        $size = $request->size;
        $qty = $request->qty;

        $cart = Session::get('cart', []);

        $product = DB::table('products')->where('id', $id)->first();

        if ($product) {
            $cartItem = [
                "id" => $product->id,
                "name" => $product->product_name,
                "qty" => $qty,
                "price" => ($product->discount_price === NULL) ? $product->selling_price : $product->discount_price,
                "weight" => 1,
                "color" => $color,
                "size" => $size,
                "image" => $product->image_one
            ];

            if (array_key_exists($id, $cart) && $product->product_quantity < $cart[$id]['qty']) {
                $notification = [
                    'message' => 'Product Out of Stock',
                    'alert-type' => 'error',
                ];
                return Redirect()->back()->with($notification);
            } elseif (array_key_exists($id, $cart)) {
                $notification = [
                    'message' => 'Allready Added On Cart.',
                    'alert-type' => 'error',
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

    public function check()
    {
        $content = Session::get('cart');
        return response()->json($content);
    }

    public function search(Request $request){

        try {
            $item = $request->search;
            $products = DB::table('products')->where('product_name', 'LIKE', "%$item%")->paginate(20);
            return view('pages.search', compact('products'));

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }


}
