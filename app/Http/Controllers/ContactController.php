<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function contact(){
        return view('pages.contact');
    }

}
