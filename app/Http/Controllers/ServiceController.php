<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //


    public $serviceRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->serviceRepository = null;
        // app(IntroductionRepository::class);
    }

    public function index(ServiceCategory $category)
    {
        $services = null;
        return view('admin.page-management.services.index',compact('services','category')); //direct to category
    }

}
