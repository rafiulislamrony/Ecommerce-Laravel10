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


}
