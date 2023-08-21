<?php

namespace App\Http\Controllers;

use App\About;
use App\Http\Repositories\AboutRepository;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public $aboutRepository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->aboutRepository = app(AboutRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($viewingId = null)
    {
        //
        $abouts = $this->aboutRepository->query()->get()->keyBy('id');
        $activeViewing = $viewingId;
        $activeViewing = $activeViewing ? $abouts[$activeViewing] : null;
        return view('admin.page-management.about.index',compact('abouts','activeViewing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.page-management.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        //
        $request->validate([
            'title'         => 'required',
            'description'   => 'required'
        ]);

        $data = [
            'title'         => $request->title,
            'description'   => $request->description
        ];

        try {
            $this->aboutRepository->save($data);
            return redirect()->route('admin.pages.about.index')->with('success', 'About Template successfully added');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
        return view('admin.page-management.about.edit',compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'title'         => 'required',
            'description'   => 'required'
        ]);

        $data = [
            'title'         => $request->title,
            'description'   => $request->description
        ];

        try {
            $this->aboutRepository->update($request->id,$data);
            return redirect()->route('admin.pages.about.index')->with('success', 'About Template successfully updated');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        $introduction = $this->aboutRepository->find($request->deleteId);
        if($introduction->active == 1){
            return redirect()->back()->with('error', 'This about is active, unable to proceed with deletion.');
        }else{
            try {
                $this->aboutRepository->delete($request->deleteId);
                return redirect()->route('admin.pages.about.index')->with('success', 'About template successfully deleted');
            }
            catch(\Exception $e) {
                return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
            }
        }
    }
}
