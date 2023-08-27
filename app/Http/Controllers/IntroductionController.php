<?php

namespace App\Http\Controllers;

use App\Introduction;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
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
            'description'   => 'required',
            'breaker'       => 'required'
        ]);

        $logo = $request->logo ? UploadHelper::uploadFile($request->logo) : null;

        $data = [
            'title'         => $request->title,
            'slogan'        => $request->slogan,
            'description'   => $request->description,
            'logo'          => $logo,
            'breaker'       => $request->breaker,
            'active'        => null
        ];

        try {
            $this->introductionRepository->save($data);
            return redirect()->route('admin.pages.introduction.index')->with('success', 'Introduction Template successfully added');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    public function edit(Introduction $introduction)
    {
        return view('admin.page-management.introduction.edit',compact('introduction'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'slogan'        => 'required',
            'description'   => 'required',
            'breaker'       => 'required'
        ]);

        $introduction = Introduction::find($request->id);

        if($introduction){

            $logo = $request->logo ? UploadHelper::uploadFile($request->logo) : $introduction->logo;

            $data = [
                'title'         => $request->title,
                'slogan'        => $request->slogan,
                'description'   => $request->description,
                'logo'          => $logo,
                'breaker'       => $request->breaker,
                'active'        => null
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

    public function delete(Request $request)
    {
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

    public function setActive(Request $request){

        $currentActive = Introduction::whereActive(1)->first();
        $currentActive->active = 0;
        $currentActive->save();
        $previousActive = $currentActive;

        $intro = $this->introductionRepository->find($request->introId);
        $intro->active = 1;
        $intro->save();

        $data = [
            'previousActive' => $previousActive,
            'newActive' => $intro
        ];

        return $data;
    }
}
