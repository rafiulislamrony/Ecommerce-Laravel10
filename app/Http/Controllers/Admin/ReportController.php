<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function todayOrder()
    {
        try {
            $today = date('d-m-y');
            $orders = DB::table('orders')->where('status', 0)->where('date', $today)->get();
            return view('admin.report.today_order', compact('orders'));
        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function todayDelivery()
    {
        try {
            $today = date('d-m-y');
            $orders = DB::table('orders')->where('status', 3)->where('date', $today)->get();
            return view('admin.report.today_delivery', compact('orders'));
        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function thisMonth()
    {
        try {
            $month = date('F');
            $orders = DB::table('orders')->where('status', 3)->where('month', $month)->get();
            return view('admin.report.this_month', compact('orders'));
        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function searchReport(){
        try{
            return view('admin.report.search');
        }catch(\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

}
