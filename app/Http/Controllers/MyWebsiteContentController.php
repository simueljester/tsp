<?php

namespace App\Http\Controllers;


use App\MyWebsite;
use App\MyWebsiteContent;
use Illuminate\Http\Request;
use App\Http\Repositories\MyWebsiteRepository;
use App\Http\Repositories\IntroductionRepository;
use App\Http\Repositories\MyWebsiteContentRepository;
use App\Http\Repositories\NewsRepository;
use App\Http\Repositories\ServiceCategoryRepository;
use App\Http\Repositories\ServiceRepository;
use App\Http\Repositories\AboutRepository;
use App\Http\Repositories\ArticleRepository;
use App\Http\Repositories\ChooseUsRepository;

class MyWebsiteContentController extends Controller
{
    public $introductionRepository, $mywebsiteRepository, $mywebsiteContentRepository, $serviceRepository, $serviceCategoryRepository, $articleRepository;
    public $aboutRepository, $newsRepository, $chooseUsRepository;
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
        $this->articleRepository = app(ArticleRepository::class);
        $this->aboutRepository = app(AboutRepository::class);
        $this->newsRepository = app(NewsRepository::class);
        $this->chooseUsRepository = app(ChooseUsRepository::class);
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

        switch ($request->content_code) {
            case 'introduction':
                MyWebsiteContent::updateOrCreate([
                    'my_website_id' => $request->website_id,
                    'content_code'  => $request->content_code
                ], [
                    'data'          => $request->data
                ]);
            break;
            case 'services':
                $ids = explode(',', $request->data);
                $data = $this->serviceRepository->query()->whereIn('id',$ids)->orderBy('created_at','DESC')->get()->toJson();
                MyWebsiteContent::updateOrCreate([
                    'my_website_id' => $request->website_id,
                    'content_code'  => $request->content_code
                ], [
                    'data'          => $data
                ]);
            break;
            case 'articles':
                $ids = explode(',', $request->data);
                $data = $this->articleRepository->query()->whereIn('id',$ids)->orderBy('created_at','DESC')->get()->toJson();
                MyWebsiteContent::updateOrCreate([
                    'my_website_id' => $request->website_id,
                    'content_code'  => $request->content_code
                ], [
                    'data'          => $data
                ]);
            break;
            case 'about':
                MyWebsiteContent::updateOrCreate([
                    'my_website_id' => $request->website_id,
                    'content_code'  => $request->content_code
                ], [
                    'data'          => $request->data
                ]);
            break;
            case 'news':
                $ids = explode(',', $request->data);
                $data = $this->newsRepository->query()->whereIn('id',$ids)->orderBy('created_at','DESC')->get()->toJson();
                MyWebsiteContent::updateOrCreate([
                    'my_website_id' => $request->website_id,
                    'content_code'  => $request->content_code
                ], [
                    'data'          => $data
                ]);
            break;
            case 'choose_us':
                $ids = explode(',', $request->data);
                $data = $this->chooseUsRepository->query()->whereIn('id',$ids)->orderBy('created_at','DESC')->get()->toJson();
                MyWebsiteContent::updateOrCreate([
                    'my_website_id' => $request->website_id,
                    'content_code'  => $request->content_code
                ], [
                    'data'          => $data
                ]);
            break;
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

        $introductions = $this->introductionRepository->query()->orderBy('created_at','DESC')->get();

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

    public function showArticles(MyWebsite $my_website)
    {

        $my_website->load('contents');

        $selectedArticles = $this->mywebsiteContentRepository->query()
        ->whereMyWebsiteId($my_website->id)
        ->whereContentCode('articles')
        ->first() ?? null;

        $getIds = [];
        if($selectedArticles){
            $selectedArticles = collect(json_decode($selectedArticles->data));
            $getIds = $selectedArticles->pluck('id')->toArray();
            $getIds = implode (",", $getIds);
        }else{
            $selectedArticles = collect();
            $getIds = '';
        }

        $articles = $this->articleRepository->query()
        ->whereNotNull('published_at')
        ->select('id','name','description','thumbnail')
        ->orderBy('name','ASC')
        ->get();

        return view('admin.website.mange-articles',compact('my_website','articles','selectedArticles','getIds'));
    }

    public function showAbout(MyWebsite $my_website)
    {

        $my_website->load('contents');

        $abouts = $this->aboutRepository->query()->orderBy('created_at','DESC')->get();

        $getAboutContent = $this->mywebsiteContentRepository->query()
        ->whereMyWebsiteId($my_website->id)
        ->whereContentCode('about')
        ->first() ?? null;

        if($getAboutContent){
            $activeAbout = json_decode($getAboutContent->data);
        }else{
            $activeAbout = null;
        }
        return view('admin.website.manage-about',compact('my_website','abouts','activeAbout'));
    }

    public function showNews(MyWebsite $my_website)
    {

        $my_website->load('contents');

        $selectedNews = $this->mywebsiteContentRepository->query()
        ->whereMyWebsiteId($my_website->id)
        ->whereContentCode('news')
        ->first() ?? null;

        $getIds = [];
        if($selectedNews){
            $selectedNews = collect(json_decode($selectedNews->data));
            $getIds = $selectedNews->pluck('id')->toArray();
            $getIds = implode (",", $getIds);
        }else{
            $selectedNews = collect();
            $getIds = '';
        }

        $news = $this->newsRepository->query()
        ->whereNotNull('published_at')
        ->select('id','name','headline','description','thumbnail')
        ->orderBy('name','ASC')
        ->get();

        return view('admin.website.mange-news',compact('my_website','news','selectedNews','getIds'));
    }

    public function showChooseUs(MyWebsite $my_website)
    {

        $my_website->load('contents');

        $selectedData = $this->mywebsiteContentRepository->query()
        ->whereMyWebsiteId($my_website->id)
        ->whereContentCode('choose_us')
        ->first() ?? null;

        $getIds = [];
        if($selectedData){
            $selectedData = collect(json_decode($selectedData->data));
            $getIds = $selectedData->pluck('id')->toArray();
            $getIds = implode (",", $getIds);
        }else{
            $selectedData = collect();
            $getIds = '';
        }

        $choose_us_data = $this->chooseUsRepository->query()
        ->select('id','name','icon','description')
        ->orderBy('name','ASC')
        ->get();

        return view('admin.website.manage-choose-us',compact('my_website','choose_us_data','selectedData','getIds'));
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
