<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function userRole()
    {
        try {
            $user = DB::table('admins')->where('type', 2)->get();
            return view('admin.role.all_role', compact('user'));
        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

    }
    public function createAdmin()
    {
        try {
            return view('admin.role.create_role');
        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

    }


}
