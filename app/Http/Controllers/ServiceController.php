<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use App\Helpers\IconHelper;
use App\Http\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //


    public $serviceRepository;
    public $icon;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->serviceRepository = app(ServiceRepository::class);
        $this->icons = IconHelper::getIcons();
    }

    public function index(ServiceCategory $category)
    {
        $services = null;
        return view('admin.page-management.services.index',compact('services','category'));
    }

    public function create(ServiceCategory $category)
    {
        $icons = $this->icons;
        sort($icons);
        return view('admin.page-management.services.create',compact('category','icons'));
    }

}
