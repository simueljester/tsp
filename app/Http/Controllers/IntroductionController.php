<?php

namespace App\Http\Controllers;

use App\Introduction;
use Illuminate\Http\Request;
use App\Http\Repositories\IntroductionRepository;

class IntroductionController extends Controller
{
    //
    public $introductionRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->introductionRepository = app(IntroductionRepository::class);
    }

    public function index($viewingId = null)
    {
        $introductions = $this->introductionRepository->query()->get()->keyBy('id');
        $activeViewing = $viewingId;
        $activeViewing = $activeViewing ? $introductions[$activeViewing] : null;
        return view('admin.page-management.introduction.index',compact('introductions','activeViewing'));
    }

    public function create()
    {
        return view('admin.page-management.introduction.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'slogan'        => 'required',
            'description'   => 'required'
        ]);

        $data = [
            'title'         => $request->title,
            'slogan'        => $request->slogan,
            'description'   => $request->description
        ];

        try {
            $this->introductionRepository->save($data);
            return redirect()->route('admin.pages.introduction.index')->with('success', 'Introduction Template successfully added');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    public function edit(Introduction $introduction){
        return view('admin.page-management.introduction.edit',compact('introduction'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'slogan'        => 'required',
            'description'   => 'required'
        ]);

        $introduction = Introduction::find($request->id);

        if($introduction){
            $data = [
                'title'         => $request->title,
                'slogan'        => $request->slogan,
                'description'   => $request->description
            ];

            try {
                $this->introductionRepository->update($request->id,$data);
                return redirect()->route('admin.pages.introduction.index')->with('success', 'Introduction Template successfully updated');
            }
            catch(\Exception $e) {
                return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
            }
        }else{
            return redirect()->route('admin.pages.introduction.index')->with('error', 'Introduction does not exist');
        }

    }

    public function delete(Request $request){
        $introduction = $this->introductionRepository->find($request->deleteId);
        if($introduction->active == 1){
            return redirect()->back()->with('error', 'This introduction is active, unable to proceed with deletion.');
        }else{
            try {
                $this->introductionRepository->delete($request->deleteId);
                return redirect()->route('admin.pages.introduction.index')->with('success', 'Introduction template successfully deleted');
            }
            catch(\Exception $e) {
                return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
            }
        }

    }
}
