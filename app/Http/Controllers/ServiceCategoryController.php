<?php

namespace App\Http\Controllers;

use App\Helpers\IconHelper;
use App\Http\Repositories\ServiceCategoryRepository;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    //
    public $categoryRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->categoryRepository = app(ServiceCategoryRepository::class);
    }

    public function index()
    {
        $services = null;
        return view('admin.page-management.services.categories.index',compact('services'));
    }

    public function create()
    {
        $icons = IconHelper::getIcons();
        sort($icons);
        return view('admin.page-management.services.categories.create',compact('icons'));
    }

    public function save(Request $request)
    {

        $request->validate([
            'name'          => 'required',
            'description'   => 'required'
        ]);

        $data = [
            'name'         => $request->name,
            'description'  => $request->description,
            'published_at' => $request->publish ? now() : null,
            'is_featured'  => $request->is_featured ? true : false
        ];

        try {
            $this->categoryRepository->save($data);
            return redirect()->route('admin.pages.services.categories.index')->with('success', 'Category successfully added');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }
}
