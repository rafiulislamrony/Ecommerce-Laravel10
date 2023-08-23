<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderTrackingController extends Controller
{

    public function getTracking()
    {
        return view('pages.tracking');
    }
    //
    public function orderTracking(Request $request) {
        try {
            $code = $request->code;
            $track = DB::table('orders')->where('status_code', $code)->first();
            if ($track) {
                return redirect('tracking/page')->with('track', $track);
            } else {
                $notification = [
                    'message' => 'Status Code Invalid.',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

}
