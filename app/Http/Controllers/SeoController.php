<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    //
    public function getSeo()
    {
        try {
            $seo = DB::table('seofd')->first();
            return view('admin.seo.seo', compact('seo'));
        } catch (\Exception $e) {

            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } 

    public function updateSeo(Request $request) {
        try {
            $data = [
                'meta_title' => $request->meta_title,
                'meta_aurthor' => $request->meta_aurthor,
                'meta_tag' => $request->meta_tag,
                'meta_description' => $request->meta_description,
                'google_analytics' => $request->google_analytics,
                'bing_analytics' => $request->bing_analytics
            ];

            DB::table('seo')->where('id', $request->id)->update($data);

            return redirect()->back()->with([
                'message' => 'Seo Update Successfully.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

}
