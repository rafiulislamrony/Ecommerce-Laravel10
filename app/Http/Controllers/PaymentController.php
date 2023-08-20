<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //
    public function PaymentPage()
    {
        $cart = Session::get('cart');
        return view('pages.payment', compact('cart'));
    }

    public function payment(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['zip'] = $request->zip;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;


        $user = Auth::id();

        if ($request->payment == 'stripe') {

            $settings = DB::table('settings')->first();
            $shipping_charge = $settings->shipping_charge;
            $vat = $settings->vat;

            $cartTotal = 0;
            if (Session::has('cart')) {
                $cart = Session::get('cart');
                if ($cart) {
                    foreach ($cart as $product) {
                        $cartTotal += (double) $product['price'] * (int) $product['qty'];
                    }
                }
            } else {
                $cart = [];
            }

            if (Session::has('coupon')) {
                $subtotal = $cartTotal - Session::get('coupon')['discount'];
            } else {
                $subtotal = $cartTotal;
            }

            $totalAmount = Session::get('totalamount')['amount'];
            $totalAmount = (int) $totalAmount;

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Stripe\Charge::create([
                "amount" => $totalAmount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from BlackBox Ecommerce."
            ]);


            $data['user_id'] = $user;
            $data['payment_id'] = $charge->payment_method;
            $data['paying_amount'] = $charge->amount;
            $data['blnc_transection'] = $charge->balance_transaction;
            $data['stripe_order_id'] = $charge->id;
            $data['subtotal'] = $subtotal;

            $data['shipping'] = $shipping_charge;
            $data['vat'] = $vat;
            $data['total'] = $totalAmount;

            $data['status'] = 0;
            $data['date'] = date('d-m-y');
            $data['month'] = date('F');
            $data['year'] = date('Y');
            $order_id = DB::table('orders_details')->insertGetId($data);
            



            $notification = [
                'message' => 'Payment successful!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification)->with(compact('data'));

        } elseif ($request->payment == 'paypal') {

            # code...
        } elseif ($request->payment == 'oncash') {

            // return view('pages.payment.oncash', compact('data'));

        } else {

            echo "Cash On Delivery";
        }
    }

}
