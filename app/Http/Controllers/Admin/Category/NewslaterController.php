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

    public function Newslater()
    {
        $sub = DB::table('newslaters')->get();
        return view('admin.newslater.newslater', compact('sub'));
    }
    public function storeNewslater(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:newslaters|max:55',
        ]);

        $data = array();
        $data['email'] = $request->email;
        DB::table('newslaters')->insert($data);

        $notification = [
            'message' => 'Thanks for Subscribing.',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }

    public function deleteSubscriber($id)
    {
        DB::table('newslaters')->where('id', $id)->delete();
        $notification = [
            'message' => 'Subscriber Deleted Successfully.',
            'alert-type' => 'success',
        ];
        return Redirect()->back()->with($notification);
    }



public function deleteSubscribers(Request $request)
{
    $ids = json_decode($request->input('ids'), true);

    if (empty($ids)) {
        return response()->json(['success' => false, 'message' => 'No subscribers selected.']);
    }

    DB::table('newslaters')->whereIn('id', $ids)->delete();

    $notification = [
        'message' => 'Subscribers deleted successfully.',
        'alert-type' => 'success',
    ];

    return Redirect()->back()->with($notification);
}





}
