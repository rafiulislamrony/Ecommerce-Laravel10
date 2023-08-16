<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    //
    public function PaymentPage(){
        $cart = Session::get('cart');
        return view('pages.payment', compact('cart'));
    }

    public function Payment(Request $request){
        $payment = $request->payment;
        echo $payment;

    }
}
