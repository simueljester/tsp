<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\IntroductionRepository;
use App\Http\Repositories\MyWebsiteRepository;
use App\MyWebsite;

class MyWebsiteController extends Controller
{
    //
    public $introductionRepository, $mywebsiteRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->introductionRepository = app(IntroductionRepository::class);
        $this->mywebsiteRepository = app(MyWebsiteRepository::class);
    }

    public function index()
    {
        $myWebsites = $this->mywebsiteRepository->query()->orderBy('created_at','DESC')->orderBy('active','DESC')->paginate(10);
        return view('admin.website.index',compact('myWebsites'));
    }

    public function create()
    {
        return view('admin.website.create');
    }

    public function save(Request $request)
    {
        //
        $request->validate([
            'name'          => 'required',
        ]);

        $data = [
            'name'     => $request->name,
            'data'     => null,
            'active'   => 0
        ];


        $website = $this->mywebsiteRepository->save($data);
        return redirect()->route('admin.my-website.manage-content.intro',$website->id)->with('success', 'Website template successfully created');

    }

    public function delete(Request $request)
    {
        //
        $website = $this->mywebsiteRepository->find($request->deleteId);
        if($website->active == 1){
            return redirect()->back()->with('error', 'This about is active, unable to proceed with deletion.');
        }else{
            try {
                $this->mywebsiteRepository->delete($request->deleteId);
                return redirect()->route('admin.my-website.index')->with('success', 'Website template successfully deleted');
            }
            catch(\Exception $e) {
                return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
            }
        }
    }
}
