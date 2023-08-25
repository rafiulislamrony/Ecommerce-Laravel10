<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function siteSetting()
    {
        try {
            $setting = DB::table('sitesetting')->first();
            return view('admin.setting.site_setting', compact('setting'));

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }


}
