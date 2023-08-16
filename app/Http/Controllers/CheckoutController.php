<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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

    public function ApplyCoupon(Request $request){

        $cart = Session::get('cart');
        $total = 0;
        foreach ($cart as $i) {
            $total += $i['price'] * $i['qty'];
        }

        $coupon = $request->coupon;
        $check = DB::table('coupons')->where('coupon', $coupon)->first();
        if($check){
            Session::put('coupon',[
                'name'=> $check->coupon,
                'discount'=> $check->discount,
                'balance'=> $total - $check->discount,
            ]);

            $notification = [
                'message' => 'Coupon Applied Successfully.',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        }else{
            $notification = [
                'message' => 'Invalid Coupon.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function RemoveCoupon(){
        Session::forget('coupon');
        $notification = [
            'message' => 'Coupon Removed Successfully.',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function PaymentPage(){
        $cart = Session::get('cart');
        return view('pages.payment', compact('cart'));
    }


}
