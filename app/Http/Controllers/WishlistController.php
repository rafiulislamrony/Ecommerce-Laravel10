<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


    public function UserWishlist()
    {
        $userid = Auth::id();

        $product = DB::table('wishlists')
            ->join('products', 'wishlists.product_id', 'products.id')
            ->select('products.*', 'wishlists.user_id')
            ->where('wishlists.user_id', $userid)
            ->get();

        return view('pages.wishlist', compact('product'));

    }

    public function RemoveWishlist($id)
    {
        $userid = Auth::id();
        DB::table('wishlists')
            ->where('product_id', $id)->where('user_id', $userid)->delete();
        return response()->json(['success' => 'This Product Remove form wishlist.']);
    }



}
