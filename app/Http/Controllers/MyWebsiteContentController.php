<?php

namespace App\Http\Controllers;

use App\MyWebsite;
use App\MyWebsiteContent;
use Illuminate\Http\Request;
use App\Http\Repositories\MyWebsiteRepository;
use App\Http\Repositories\IntroductionRepository;
use App\Http\Repositories\MyWebsiteContentRepository;
use App\Http\Repositories\ServiceCategoryRepository;
use App\Http\Repositories\ServiceRepository;

class MyWebsiteContentController extends Controller
{
    public $introductionRepository, $mywebsiteRepository, $mywebsiteContentRepository, $serviceRepository, $serviceCategoryRepository;

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
        $this->serviceRepository = app(ServiceRepository::class);
        $this->serviceCategoryRepository = app(ServiceCategoryRepository::class);
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

        if($request->content_code == 'introduction'){
            MyWebsiteContent::updateOrCreate([
                'my_website_id' => $request->website_id,
                'content_code'  => $request->content_code
            ], [
                'data'          => $request->data
            ]);
        }else{
            $ids = explode(',', $request->data);

            $data = $this->serviceRepository->query()->whereIn('id',$ids)->get()->toJson();

            MyWebsiteContent::updateOrCreate([
                'my_website_id' => $request->website_id,
                'content_code'  => $request->content_code
            ], [
                'data'          => $data
            ]);
        }

        return redirect()->back()->with('success', 'Successfuly saved');
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

        $selectedServices = $this->mywebsiteContentRepository->query()
        ->whereMyWebsiteId($my_website->id)
        ->whereContentCode('services')
        ->first() ?? null;

        $getIds = [];
        if($selectedServices){
            $selectedServices = collect(json_decode($selectedServices->data));
            $getIds = $selectedServices->pluck('id')->toArray();
            $getIds = implode (",", $getIds);

        }else{
            $selectedServices = collect();
            $getIds = '';
        }

        $services = $this->serviceRepository->query()
        ->whereNotNull('published_at')
        ->select('id','name','description_clean','icon')
        ->orderBy('name','ASC')
        ->get();

        return view('admin.website.manage-services',compact('my_website','services','selectedServices','getIds'));
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
