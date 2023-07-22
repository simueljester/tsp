<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageLandingController extends Controller
{
    //
    public function index(){
        return view('landing.template-1.index');
    }
}
