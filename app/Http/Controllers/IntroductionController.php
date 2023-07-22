<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\IntroductionRepository;

class IntroductionController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.page-management.introduction.index');
    }

    public function create(){
        return view('admin.page-management.introduction.create');
    }

    public function save(Request $request){

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
            app(IntroductionRepository::class)->save($data);
            return redirect()->route('admin.pages.introduction.index')->with('success', 'Introduction Template successfully added');
        }
        //catch exception
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Unable to create');
        }
    }
}
