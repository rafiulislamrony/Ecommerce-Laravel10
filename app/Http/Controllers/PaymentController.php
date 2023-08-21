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

        if ($request->payment == 'stripe') {
            // Get Shopping Charge And vat
            $settings = DB::table('settings')->first();
            $shipping_charge = $settings->shipping_charge;
            $vat = $settings->vat;
            // Get Session Cart And cart Total
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
            // Get Carttotal if have Coupon
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
                "description" => "BlackBox Ecommerce.",
                "metadata" => ['order_id'=> uniqid()],
            ]);

            // Insert Data In orders Table
            $user = Auth::id();
            $data = array();
            $data['user_id'] = $user;
            $data['payment_id'] = $charge->payment_method;
            $data['paying_amount'] = number_format($charge->amount / 100, 2, '.', ',');
            $data['blnc_transection'] = $charge->balance_transaction;
            $data['stripe_order_id'] = $charge->metadata->order_id;
            $data['subtotal'] = $subtotal;
            $data['shipping'] = $shipping_charge;
            $data['vat'] = $vat;
            $data['total'] = $totalAmount;
            $data['status'] = 0;
            $data['date'] = date('d-m-y');
            $data['month'] = date('F');
            $data['year'] = date('Y');
            $order_id = DB::table('orders')->insertGetId($data);

            // Insert Data In Shipping Table
            $shipping = array();
            $shipping['order_id'] = $order_id;
            $shipping['ship_name'] = $request->name;
            $shipping['ship_phone'] = $request->phone;
            $shipping['ship_email'] = $request->email;
            $shipping['ship_address'] = $request->address;
            $shipping['ship_city'] = $request->city;
            $shipping['ship_zip'] = $request->zip;
            DB::table('shipping')->insert($shipping);

            // Insert Data In orders Table
            $cart = Session::get('cart');
            $details = array();
            if ($cart) {
                foreach ($cart as $row) {
                    $details['order_id'] = $order_id;
                    $details['product_id'] = $row['id'];
                    $details['product_name'] = $row['name'];
                    $details['color'] = $row['color'];
                    $details['size'] = $row['size'];
                    $details['quantity'] = $row['qty'];
                    $details['singpleprice'] = $row['price'];
                    $details['totalprice'] = $row['qty'] * $row['price'];
                    DB::table('orders_details')->insert($details);
                }
            }

            Session::forget('cart');
            if(Session::has('coupon')){
                Session::forget('coupon');
            }

            $notification = [
                'message' => 'Payment and Order Successfully Done.',
                'alert-type' => 'success',
            ];
            return redirect()->to('/')->with($notification);

        } elseif ($request->payment == 'paypal') {

            # code...
        } elseif ($request->payment == 'oncash') {

            // return view('pages.payment.oncash', compact('data'));

        } else {

            echo "Cash On Delivery";
        }
    }

}
