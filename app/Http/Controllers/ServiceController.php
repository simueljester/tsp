<?php

namespace App\Http\Controllers;

use App\Article;
use App\Service;
use App\ServiceCategory;
use App\Helpers\IconHelper;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\TagRepository;
use App\Http\Repositories\ServiceRepository;
use App\Http\Repositories\ServiceCategoryRepository;

class ServiceController extends Controller
{
    //


    public $serviceRepository, $categoryRepository, $tagRepository;
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
        $this->categoryRepository = app(ServiceCategoryRepository::class);
        $this->tagRepository = app(TagRepository::class);
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

    public function indexUncategorize()
    {

        $services = $this->serviceRepository->query()
        ->whereCategoryId(null)
        ->with('category:id,name,icon')
        ->select('id','name','type','icon','description_clean','published_at','category_id','created_at')
        ->orderBy('created_at','DESC')
        ->get();

        $categories = $this->categoryRepository->query()->get();

        return view('admin.page-management.services.index-uncategorized',compact('services','categories'));
    }

    public function create(ServiceCategory $category)
    {
        $icons = $this->icons;
        sort($icons);

        $tags = $this->tagRepository->query()->select('id','name')->get();

        return view('admin.page-management.services.create',compact('category','icons','tags'));
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

        $tags = $request->tags ? array_values($request->tags) : [];
        $newly_tags =  $request->newly_tags ? array_values($request->newly_tags) : [];
        $store_tags = array_merge($tags,$newly_tags);

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
            'is_featured'       => null,
            'tags'              => implode (", ", $store_tags)
        ];

        $listRedirection = $request->save == 1 ? true : false;

        $this->tagRepository->saveNewlyCreatedTags($newly_tags);
        $this->serviceRepository->save($data);

        if($listRedirection == true){
            return redirect()->route('admin.pages.services.index',$request->category_id)->with('success', 'Service successfully added');
        }else{
            return redirect()->route('admin.pages.services.create',$request->category_id)->with('success', 'Service successfully added');
        }
    }

    public function show(Service $service)
    {

        $service->load('category');
        $categories = $this->categoryRepository->query()->get();
        $service->tags = explode(',', $service->tags);
        return view('admin.page-management.services.show',compact('service','categories'));
    }

    public function edit(Service $service)
    {
        $service->load('category');

        $icons = $this->icons;
        sort($icons);

        $tags = $this->tagRepository->query()->select('id','name')->get();
        return view('admin.page-management.services.edit',compact('service','icons','tags'));
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

        $tags = $request->tags ? array_values($request->tags) : [];
        $newly_tags =  $request->newly_tags ? array_values($request->newly_tags) : [];
        $store_tags = array_merge($tags,$newly_tags);

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
            'is_featured'       => null,
            'tags'              => implode (", ", $store_tags)
        ];



        $this->tagRepository->saveNewlyCreatedTags($newly_tags);
        $this->serviceRepository->update($request->id,$data);
        return redirect()->route('admin.pages.services.show',$request->id)->with('success', 'Service successfully updated');

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

    public function delete(Request $request){
        try {

            Article::whereServiceId($request->deleteId)->update(['service_id'=>null]); // mark null the articles under this id instead of deleting

            $this->serviceRepository->delete($request->deleteId);

            if($request->categoryId){
                return redirect()->route('admin.pages.services.index',$request->categoryId)->with('success', 'Category successfully deleted');
            }else{
                return redirect()->route('admin.pages.services.index-uncategorized')->with('success', 'Category successfully deleted');
            }

        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

}
