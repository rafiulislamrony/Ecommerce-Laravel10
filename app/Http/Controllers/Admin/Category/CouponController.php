<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Coupon(){
        $coupon = DB::table('coupons')->get();
        return view('admin.coupon.coupon', compact('coupon'));
    }
    public function CouponStore(Request $request){
        $request->validate([
            'coupon' => 'required',
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

    public function CouponDelete($id)
    {
        DB::table('coupons')->where('id', $id)->delete();
        $notification = [
            'message' => 'Coupon Delete Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }

    public function CouponEdit($id)
    {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.coupon.edit_coupon', compact('coupon'));
    }
    public function CouponUpdate(Request $request, $id){
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->where('id', $id)->update($data);

        $notification = [
            'message' => 'Coupon Update Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->route('admin.coupon')->with($notification);
    }


}
