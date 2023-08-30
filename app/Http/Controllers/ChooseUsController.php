<?php

namespace App\Http\Controllers;

use App\ChooseUs;
use App\Helpers\IconHelper;
use Illuminate\Http\Request;
use App\Http\Repositories\ChooseUsRepository;

class ChooseUsController extends Controller
{
    //
    public $chooseUsRepository;
    public $icon;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->chooseUsRepository = app(ChooseUsRepository::class);
        $this->icons = IconHelper::getIcons();
    }

    public function index()
    {
        //
        $datas = $this->chooseUsRepository->query()->select('id','name','description','icon')->orderBy('active','DESC')->paginate(10);
        return view('admin.page-management.choose-us.index',compact('datas'));
    }

    public function create()
    {
        $icons = $this->icons;
        sort($icons);

        return view('admin.page-management.choose-us.create',compact('icons'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'description'  => 'required'
        ]);

        $data = [
            'icon'         => $request->icon,
            'name'         => ucfirst($request->name),
            'description'  => $request->description
        ];

        try {
            $this->chooseUsRepository->save($data);
            return redirect()->route('admin.pages.choose-us.index')->with('success', 'Template successfully added');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    public function show(ChooseUs $choose_us)
    {
        return view('admin.page-management.choose-us.show',compact('choose_us'));
    }

    public function edit(ChooseUs $choose_us)
    {
        $icons = $this->icons;
        sort($icons);

        return view('admin.page-management.choose-us.edit',compact('icons','choose_us'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'description'  => 'required'
        ]);

        $data = [
            'icon'         => $request->icon,
            'name'         => ucfirst($request->name),
            'description'  => $request->description
        ];

        try {
            $this->chooseUsRepository->update($request->id,$data);
            return redirect()->route('admin.pages.choose-us.index')->with('success', 'Template successfully updated');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    public function delete(Request $request)
    {
        $introduction = $this->chooseUsRepository->find($request->deleteId);

        if($introduction->active == 1){
            return redirect()->back()->with('error', 'This choose us template is active, unable to proceed with deletion.');
        }else{
            try {
                $this->chooseUsRepository->delete($request->deleteId);
                return redirect()->route('admin.pages.choose-us.index')->with('success', 'Choose us template successfully deleted');
            }
            catch(\Exception $e) {
                return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
            }
        }
    }
}
