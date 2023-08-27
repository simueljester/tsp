<?php

namespace App\Http\Controllers;

use App\MyWebsite;
use App\MyWebsiteContent;
use Illuminate\Http\Request;
use App\Http\Repositories\MyWebsiteRepository;
use App\Http\Repositories\IntroductionRepository;
use App\Http\Repositories\MyWebsiteContentRepository;

class MyWebsiteContentController extends Controller
{
    public $introductionRepository, $mywebsiteRepository, $mywebsiteContentRepository;

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
        $this->mywebsiteContentRepository = app(MyWebsiteContentRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'website_id'    => 'required',
            'data'          => 'required'
        ]);

        MyWebsiteContent::updateOrCreate([
            'my_website_id' => $request->website_id
        ], [
            'content_code' => $request->content_code,
            'data' => $request->data
        ]);

        return redirect()->back()->with('success', 'Introduction Selected');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MyWebsiteContent  $myWebsiteContent
     * @return \Illuminate\Http\Response
     */
    public function showIntro(MyWebsite $my_website)
    {

        $my_website->load('contents');
        $introductions = $this->introductionRepository->query()->get();
        $getIntroContent = $this->mywebsiteContentRepository->query()
        ->whereMyWebsiteId($my_website->id)
        ->whereContentCode('introduction')
        ->first() ?? null;

        if($getIntroContent){
            $activeIntro = json_decode($getIntroContent->data);
        }else{
            $activeIntro = null;
        }
        return view('admin.website.manage-intro',compact('my_website','introductions','activeIntro'));
    }

    public function showServices(MyWebsite $my_website)
    {

        $my_website->load('contents');
        return view('admin.website.manage-services',compact('my_website'));
    }



    public function show(MyWebsiteContent $myWebsiteContent)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MyWebsiteContent  $myWebsiteContent
     * @return \Illuminate\Http\Response
     */
    public function edit(MyWebsiteContent $myWebsiteContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MyWebsiteContent  $myWebsiteContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyWebsiteContent $myWebsiteContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MyWebsiteContent  $myWebsiteContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyWebsiteContent $myWebsiteContent)
    {
        //
    }
}
