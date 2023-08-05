<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceCategory;
use App\Helpers\IconHelper;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use Illuminate\Validation\Rule;
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
        ->select('id','name','type','icon','description_clean','published_at','category_id','created_at')
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
            'name'              => ucwords($request->name),
            'slug'              => $request->slug,
            'type'              => $request->type,
            'description'       => $request->description,
            'description_clean' => strip_tags($request->description),
            'category_id'       => $request->category_id,
            'icon'              => $request->icon,
            'multimedia'        => $multimedia,
            'files'             => null,
            'published_at'      => $request->publish ? now() : null,
            'is_featured'       => false
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

    public function show(Service $service)
    {
        $service->load('category');
        return view('admin.page-management.services.show',compact('service'));
    }

    public function edit(Service $service)
    {
        $service->load('category');
        $icons = $this->icons;
        sort($icons);
        return view('admin.page-management.services.edit',compact('service','icons'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'type'          => 'required',
            'slug'          => ['required',Rule::unique('services')->ignore($request->id)],
            'icon'          => 'required'
        ]);

        $service = $this->serviceRepository->find($request->id);

        $existingMediaArr = $service->multimedia ? json_decode($service->multimedia,true) : []; //existing
        $additionalMediaArr = $request->multimedia ? explode(',', $request->multimedia) : []; //additional

        $multimedia = array_merge($existingMediaArr,$additionalMediaArr);
        $multimedia = count($multimedia) != 0 ? json_encode($multimedia) : null;

        $data = [
            'name'              => ucwords($request->name),
            'slug'              => $request->slug,
            'type'              => $request->type,
            'description'       => $request->description,
            'description_clean' => strip_tags($request->description),
            'category_id'       => $request->category_id,
            'icon'              => $request->icon,
            'multimedia'        => $multimedia,
            'files'             => null,
            'published_at'      => $request->publish ? now() : null,
            'is_featured'       => false
        ];


        try {
            $this->serviceRepository->update($request->id,$data);
            return redirect()->route('admin.pages.services.show',$request->id)->with('success', 'Service successfully updated');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', $e);
        }

    }

    public function removeImage(Request $request)
    {
        $service = $this->serviceRepository->find($request->serviceId);
        $multimedia = json_decode($service->multimedia,true);
        $newVal = array_filter($multimedia, fn ($m) => $m != $request->multimediaName); //remove from array list
        if(count($newVal) != 0){
            $service->multimedia = json_encode(array_values($newVal));
        }else{
            $service->multimedia = null;
        }
        $service->save();

        return redirect()->back()->with('success','Image successfully removed from this service');

    }

}
