<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageLandingController extends Controller
{
    //
    public function index(){
        return view('page.landing.index');
    }
}
