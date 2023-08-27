<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactForm(Request $request)
    {
        try {
            $data = array();
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['message'] = $request->message;

            DB::table('contact')->insert($data);

            $notification = [
                'message' => 'Your Message Send Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function allMessage()
    {
        try {
            $allmessage = DB::table('contact')->get();

            return view('admin.contact.all_message', compact('allmessage'));

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function ViewMessage($id)
    {
        try {
            $message = DB::table('contact')->where('id', $id)->first();

            return view('admin.contact.view_message', compact('message'));

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }




}
