<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class PaymentController extends Controller
{
    //
    public function PaymentPage()
    {
        try {
            $cart = Session::get('cart');
            return view('pages.payment', compact('cart'));
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }


    public function payment(Request $request)
    {
         try {
            if ($request->payment == 'stripe') {
                // Get settings Data
                $settings = DB::table('settings')->first();
                $shipping_charge = $settings->shipping_charge;
                $vat = $settings->vat;

                $email = Auth::user()->email;

                // Calculate cart total
                $cartTotal = 0;
                $cart = Session::get('cart') ?: [];


                foreach ($cart as $product) {
                    $cartTotal += (double) $product['price'] * (int) $product['qty'];
                }
                // Calculate subtotal and total amount
                $subtotal = $cartTotal - (Session::has('coupon') ? Session::get('coupon')['discount'] : 0);
                $totalAmount = (int) Session::get('totalamount')['amount'];

                // Create Stripe charge
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $charge = Stripe\Charge::create([
                    "amount" => $totalAmount * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "BlackBox Ecommerce.",
                    "metadata" => ['order_id' => uniqid()],
                ]);

                // Store order data
                $user = Auth::id();
                $data = array();
                $data['user_id'] =  $user;
                $data['payment_type'] = $request->payment;
                $data['payment_id'] =  $charge->payment_method;
                $data['paying_amount'] = number_format($charge->amount / 100, 2, '.', ',');
                $data['blnc_transection'] = $charge->balance_transaction;
                $data['stripe_order_id'] = $charge->metadata->order_id;
                $data['subtotal'] =  $subtotal;
                $data['shipping'] = $shipping_charge;
                $data['vat'] = $vat;
                $data['total'] = $totalAmount;
                $data['status'] = 0;
                $data['date'] = date('d-m-y');
                $data['month'] = date('F');
                $data['year'] = date('Y');
                $data['status_code'] = mt_rand(100000, 999999);

                $order_id = DB::table('orders')->insertGetId($data);

                // Mail Send to User for Invoice
                Mail::to($email)->send(new InvoiceMail($data));


                // Store shipping information
                $shipping = [
                    'order_id' => $order_id,
                    'ship_name' => $request->name,
                    'ship_phone' => $request->phone,
                    'ship_email' => $request->email,
                    'ship_address' => $request->address,
                    'ship_city' => $request->city,
                    'ship_zip' => $request->zip,
                ];
                DB::table('shipping')->insert($shipping);

                // Store order details for each product
                $details = [];
                foreach ($cart as $row) {
                    $details[] = [
                        'order_id' => $order_id,
                        'product_id' => $row['id'],
                        'product_name' => $row['name'],
                        'color' => $row['color'],
                        'size' => $row['size'],
                        'quantity' => $row['qty'],
                        'singpleprice' => $row['price'],
                        'totalprice' => $row['qty'] * $row['price'],
                    ];
                }
                DB::table('orders_details')->insert($details);

                // Clear session data
                Session::forget('cart');
                if (Session::has('coupon')) {
                    Session::forget('coupon');
                }
                // Success notification and redirect
                $notification = [
                    'message' => 'Payment and Order Successfully Done.',
                    'alert-type' => 'success',
                ];
                return redirect()->to('/')->with($notification);
            } elseif ($request->payment == 'paypal') {
                // PayPal handling code
            } elseif ($request->payment == 'oncash') {
                // On Cash handling code
            } else {
                echo "Cash On Delivery";
            }
        } catch (\Exception $e) {
            // Handle exception
            $notification = [
                'message' => 'An error occurred while processing your payment. try latter.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
