<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewslaterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Newslater(){
        $sub = DB::table('newslaters')->get();
        return view('admin.newslater.newslater', compact('sub'));
    }
    public function storeNewslater(Request $request){
        $request->validate([
            'email' => 'required',
            'discount' => 'required',
        ]);

        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->insert($data);

        $notification = [
            'message' => 'Coupon Added Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }

}
