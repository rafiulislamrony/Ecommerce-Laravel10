<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SeoController extends Controller
{
    //
    public function getSeo(){
       $seo = DB::table('seo')->first();
       return view('admin.seo.seo', compact('seo'));
    }

    public function updateSeo(Request $request){

        $id = $request->id;

        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_aurthor'] = $request->meta_aurthor;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['google_analytics'] = $request->google_analytics;
        $data['bing_analytics'] = $request->bing_analytics;

        DB::table('seo')->where('id', $id)->update($data);

        $notification = [
            'message' => 'Seo Update Successfully.',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
