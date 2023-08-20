<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

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

        if ($request->payment == 'stripe') {

            $totalAmount = Session::get('totalamount')['amount'];

            $totalAmount = (int) $totalAmount;

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create([
                "amount" => $totalAmount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from BlackBox Ecommerce."
            ]);

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
