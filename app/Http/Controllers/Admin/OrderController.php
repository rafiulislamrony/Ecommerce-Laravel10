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
    public function userViewOrder($id){
        $userOrder = DB::table('orders')
        ->join('users', 'orders.user_id', 'users.id')
        ->select('orders.*','users.name','users.email')
        ->where('orders.id', $id)->first();

        $userShipping = DB::table('shipping')->where('order_id', $id)->first();

        $userOrderDetails = DB::table('orders_details')
        ->join('products', 'orders_details.product_id', 'products.id')
        ->select('orders_details.*','products.product_code','products.image_one')
        ->where('orders_details.order_id', $id)->get();

        return view('pages.user_order_details', compact('userOrder', 'userShipping', 'userOrderDetails'));
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


    public function paymentAcceptOrders(){
        $orders = DB::table('orders')->where('status', 1)->get();
        return view('admin.order.pending_order', compact('orders'));
    }
    public function processingOrders(){
        $orders = DB::table('orders')->where('status', 2)->get();
        return view('admin.order.pending_order', compact('orders'));
    }
    public function daliveredOrders(){
        $orders = DB::table('orders')->where('status', 3)->get();
        return view('admin.order.pending_order', compact('orders'));
    }
    public function cancleOrders(){
        $orders = DB::table('orders')->where('status', 4)->get();
        return view('admin.order.pending_order', compact('orders'));
    }

    public function deleveryProcess($id){
        DB::table('orders')->where('id', $id)->update(['status'=>2]);
        $notification = [
            'message' => 'Send to Delevery.',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.accept.payment')->with($notification);
    }
    public function deleveryDone($id){

        $product = DB::table('orders_details')->where('order_id',$id)->get();

        foreach($product as $row){
            DB::table('products')->where('id',$row->product_id)
            ->update(['product_quantity' => DB::raw('product_quantity-'.$row->quantity)]);
        }

        DB::table('orders')->where('id', $id)->update(['status'=> 3]);


        $notification = [
            'message' => 'Order Develered.',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.dalivered.orders')->with($notification);

    }


}
