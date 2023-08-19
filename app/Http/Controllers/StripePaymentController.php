<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Session;


class StripePaymentController extends Controller
{ 
    public function stripePost(Request $request)
    {

        $totalAmount = Session::get('totalamount')['amount'];

        $totalAmount = (int) $totalAmount;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalAmount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from BlackBox Ecommerce."
        ]);

        $notification = [
            'message' => 'Payment successful!',
            'alert-type' => 'success',
        ];
        return redirect()->route('dashboard')->with($notification);
    }
}
