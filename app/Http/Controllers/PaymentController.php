<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    //
    public function PaymentPage()
    {
        $cart = Session::get('cart');
        return view('pages.payment', compact('cart'));
    }

    public function Payment(Request $request)
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
            return view('pages.payment.stripe', compact('data'));

        } elseif ($request->payment == 'paypal') {

        } elseif ($request->payment == 'ideal') {

        } else {
            echo "Cash On Dalivary";
        }

    }





}
