<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function storeAdmin(Request $request)
    {
        try {
            $data = array();
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['category'] = $request->category;
            $data['coupon'] = $request->coupon;
            $data['products'] = $request->products;
            $data['blog'] = $request->blog;
            $data['orders'] = $request->orders;
            $data['other'] = $request->other;
            $data['report'] = $request->report;
            $data['role'] = $request->role;
            $data['returns'] = $request->returns;
            $data['contact'] = $request->contact;
            $data['comment'] = $request->comment;
            $data['setting'] = $request->setting;
            $data['stock'] = $request->stock;
            $data['type'] = 2;

            DB::table('admins')->insert($data);

            $notification = [
                'message' => 'Admin Inserted Successfully.',
                'alert-type' => 'success',
            ];
            return redirect()->route('admin.all.user')->with($notification);

        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function deleteAdmin($id)
    {
        try {
            DB::table('admins')->where('id', $id)->delete();

            $notification = [
                'message' => 'Admin Deleted Successfully.',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function editAdmin($id)
    {
        try {
           $user = DB::table('admins')->where('id', $id)->first();

            return view('admin.role.edit_role', compact('user') );

        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function updateAdmin(Request $request)
    {
        try {

            $id = $request->id;

            $data = array();
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['category'] = $request->category;
            $data['coupon'] = $request->coupon;
            $data['products'] = $request->products;
            $data['blog'] = $request->blog;
            $data['orders'] = $request->orders;
            $data['other'] = $request->other;
            $data['report'] = $request->report;
            $data['role'] = $request->role;
            $data['returns'] = $request->returns;
            $data['contact'] = $request->contact;
            $data['comment'] = $request->comment;
            $data['setting'] = $request->setting;
            $data['stock'] = $request->stock;
            $data['type'] = 2;

            DB::table('admins')->where('id',$id)->update($data);

            $notification = [
                'message' => 'Admin Updated Successfully.',
                'alert-type' => 'success',
            ];
            return redirect()->route('admin.all.user')->with($notification);

        } catch (\Exception $e) {
            // Handle the exception here
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function productStock()
    {
        try {
            $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name', 'subcategories.subcategory_name')
            ->get();

            return view('admin.stock.stock', compact('product') );

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
