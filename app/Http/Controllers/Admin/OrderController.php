<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminNewOrder(){
       $orders = DB::table('orders')->where('status', 0)->get();
       return view('admin.order.pending_order', compact('orders'));

    }

    public function viewOrder($id){
        $order = DB::table('orders')
        ->join('users', 'orders.user_id', 'users.id')
        ->select('orders.*','users.name','users.email')
        ->where('orders.id', $id)->first();

        $shipping = DB::table('shipping')->where('order_id', $id)->first();

        $orderDetails = DB::table('orders_details')
        ->join('products', 'orders_details.product_id', 'products.id')
        ->select('orders_details.*','products.product_code','products.image_one')
        ->where('orders_details.order_id', $id)->get();

        return view('admin.order.view_order', compact('order', 'shipping', 'orderDetails'));
    }

    public function paymentAccept($id){
        DB::table('orders')->where('id', $id)->update(['status'=>1]);
        $notification = [
            'message' => 'Payment Accept Done.',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.neworder')->with($notification);
    }
    public function orderCancle($id){
        DB::table('orders')->where('id', $id)->update(['status'=>4]);
        $notification = [
            'message' => 'Order Cancled.',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.neworder')->with($notification);
    }


}
