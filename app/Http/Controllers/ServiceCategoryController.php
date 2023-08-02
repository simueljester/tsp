<?php

namespace App\Http\Controllers;

use App\Helpers\IconHelper;
use App\Http\Repositories\ServiceCategoryRepository;
use App\ServiceCategory;
use Illuminate\Http\Request;

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
        $categories = $this->categoryRepository->query()->get();
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
            'description'   => 'required',
            'icon'          => 'required'
        ]);

        $data = [
            'name'         => $request->name,
            'description'  => $request->description,
            'published_at' => $request->publish ? now() : null,
            'is_featured'  => $request->is_featured ? true : false,
            'icon'         => $request->icon,
        ];

        try {
            $this->categoryRepository->save($data);
            return redirect()->route('admin.pages.services.categories.index')->with('success', 'Category successfully added');
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
            'description'   => 'required',
            'icon'          => 'required'
        ]);

        $category = ServiceCategory::find($request->id);

        if($category){
            $data = [
                'name'         => $request->name,
                'description'  => $request->description,
                'published_at' => $request->publish ? now() : null,
                'is_featured'  => $request->is_featured ? true : false,
                'icon'         => $request->icon,
            ];

            try {
                $this->categoryRepository->update($request->id,$data);
                return redirect()->route('admin.pages.services.categories.index')->with('success', 'Category successfully updated');
            }
            catch(\Exception $e) {
                return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
            }
        }else{
            return redirect()->route('admin.pages.introduction.index')->with('error', 'Category does not exist');
        }

    }

    public function delete(Request $request){
        // $introduction = $this->categoryRepository->find($request->deleteId);

        try {
            $this->categoryRepository->delete($request->deleteId);
            return redirect()->route('admin.pages.services.categories.index')->with('success', 'Category successfully deleted');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }


    }
}
