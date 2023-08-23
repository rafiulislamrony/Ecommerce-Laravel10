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
}
