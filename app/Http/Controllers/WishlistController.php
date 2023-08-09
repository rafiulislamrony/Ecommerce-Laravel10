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
                $notification = [
                    'message' => 'Already has in your Wishlist.',
                    'alert-type' => 'error',
                ];
                return Redirect()->back()->with($notification);
            } else {
                DB::table('wishlists')->insert($data);
                $notification = [
                    'message' => 'Add to Wishlist.',
                    'alert-type' => 'success',
                ];
                return Redirect()->back()->with($notification);
            }
        } else {
            $notification = [
                'message' => 'Please login First.',
                'alert-type' => 'warning',
            ];
            return Redirect()->back()->with($notification);
        }



    }
}
