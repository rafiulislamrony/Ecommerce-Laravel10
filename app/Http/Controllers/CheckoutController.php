<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //
    public function Checkout()
    {
        if (Auth::check()) {
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                return view('pages.checkout', compact('cart'));
            }else {
                $notification = [
                    'message' => 'Please Add to Cart at least One Product.',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = [
                'message' => 'At First Login Your Account.',
                'alert-type' => 'error',
            ];
            return redirect()->route('login')->with($notification);
        }
    }


}
