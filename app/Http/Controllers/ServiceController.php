<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use App\Helpers\IconHelper;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Repositories\ServiceRepository;

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
        $services = $this->serviceRepository->query()
        ->whereCategoryId($category->id)
        ->with('category:id,name,icon')
        ->select('name','type','icon','description','published_at','category_id','created_at')
        ->orderBy('created_at','DESC')
        ->get();
        return view('admin.page-management.services.index',compact('services','category'));
    }

    public function create(ServiceCategory $category)
    {
        $icons = $this->icons;
        sort($icons);
        return view('admin.page-management.services.create',compact('category','icons'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'type'          => 'required',
            'slug'          => 'required|unique:services,slug|max:191',
            'icon'          => 'required'
        ]);

        $multimedia = $request->multimedia ? json_encode(explode(',', $request->multimedia)) : null;

        $data = [
            'name'          => ucwords($request->name),
            'slug'          => $request->slug,
            'type'          => $request->type,
            'description'   => $request->description,
            'category_id'   => $request->category_id,
            'icon'          => $request->icon,
            'multimedia'    => $multimedia,
            'files'         => null,
            'published_at'  => $request->publish ? now() : null
        ];

        $listRedirection = $request->save == 1 ? true : false;

        try {
            $this->serviceRepository->save($data);
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', $e);
        }

        if($listRedirection == true){
            return redirect()->route('admin.pages.services.index',$request->category_id)->with('success', 'Service successfully added');
        }else{
            return redirect()->route('admin.pages.services.create',$request->category_id)->with('success', 'Service successfully added');
        }


    }

}
