<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceCategory;
use App\Helpers\IconHelper;
use Illuminate\Http\Request;
use App\Http\Repositories\ServiceCategoryRepository;

class ServiceCategoryController extends Controller
{
    //
    public $categoryRepository;
    public $icons;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->categoryRepository = app(ServiceCategoryRepository::class);
        $this->icons = IconHelper::getIcons();
    }

    public function index()
    {
        $categories = $this->categoryRepository->query()->withCount('services')->get();
        return view('admin.page-management.services.categories.index',compact('categories'));
    }

    public function create()
    {
        $icons = $this->icons;
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
            'name'         => ucwords($request->name),
            'description'  => $request->description,
            'published_at' => $request->publish ? now() : null,
            'is_featured'  => null,
            'icon'         => null,
        ];

        try {
            $category = $this->categoryRepository->save($data);
            return redirect()->route('admin.pages.services.index',$category->id)->with('success', 'Category successfully added');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    public function edit(ServiceCategory $category)
    {
        $icons = $this->icons;
        sort($icons);
        return view('admin.page-management.services.categories.edit',compact('category','icons'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required'
        ]);

        $category = ServiceCategory::find($request->id);

        if($category){
            $data = [
                'name'         => $request->name,
                'description'  => $request->description,
                'published_at' => $request->publish ? now() : null,
                'is_featured'  => null,
                'icon'         => $request->icon,
            ];

            try {
                $this->categoryRepository->update($request->id,$data);
                return redirect()->route('admin.pages.services.index',$request->id)->with('success', 'Category successfully updated');
            }
            catch(\Exception $e) {
                return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
            }
        }else{
            return redirect()->route('admin.pages.introduction.index')->with('error', 'Category does not exist');
        }

    }

    public function delete(Request $request){
        try {

            // instead of deleting, mark null the existing service under this category
            Service::whereCategoryId($request->deleteId)->update(['category_id'=>null]);

            $this->categoryRepository->delete($request->deleteId);
            return redirect()->route('admin.pages.services.categories.index')->with('success', 'Category successfully deleted');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    public function reassignService(Request $request){

        $selected_services =  explode(',', $request->selectedServices);

        try{
            Service::whereIn('id',$selected_services)->update(['category_id'=>$request->categoryId]);
            return redirect()->route('admin.pages.services.index',$request->categoryId)->with('success', 'Services successfully reassigned!');

        }catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }

   }
}
