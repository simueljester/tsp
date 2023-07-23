<?php

namespace App\Http\Controllers;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
}
