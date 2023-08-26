<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReturnOrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function successOrderList(){
        try{
            $id = Auth::id();
            $order= DB::table('orders')->where('user_id', $id)->where('status', 3)->orderBy('id', 'DESC')->limit(5)->get();
            return view('pages.returnorder', compact('order'));

        }catch(\Exception $e){
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function returnRequest($id){
        try{
            DB::table('orders')->where('id', $id)->update(['return_order' => 1]);
            $notification = [
                'message' => 'Order Return Request Done.',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        }catch(\Exception $e){
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }




}
