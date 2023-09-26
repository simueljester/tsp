<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ArticleRepository;
use App\Http\Repositories\InquiryRepository;
use Illuminate\Http\Request;
use App\Http\Repositories\MyWebsiteRepository;
use App\Http\Repositories\MyWebsiteContentRepository;
use App\Http\Repositories\NewsRepository;
use App\Http\Repositories\ServiceRepository;

class DashboardController extends Controller
{
    public $mywebsiteRepository, $mywebsiteContentRepository, $articleRepository, $newsRepository, $serviceRepository, $inquiryRepository;

    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->mywebsiteRepository = app(MyWebsiteRepository::class);
        $this->mywebsiteContentRepository = app(MyWebsiteContentRepository::class);
        $this->articleRepository = app(ArticleRepository::class);
        $this->newsRepository = app(NewsRepository::class);
        $this->serviceRepository = app(ServiceRepository::class);
        $this->inquiryRepository = app(InquiryRepository::class);
    }
    public function index()
    {
        $activeWebsite = $this->mywebsiteRepository->query()->whereActive(1)
        ->select('id','name')
        ->first() ?? null;
        $activeIntro = '';

        if($activeWebsite){
            $activeIntro = $this->mywebsiteContentRepository->query()
            ->whereMyWebsiteId($activeWebsite->id)
            ->whereContentCode('introduction')
            ->first() ?? null;
        }

        $activeIntro = $activeIntro == '' ? null : json_decode($activeIntro->data);
        $unreadInquiry = $this->inquiryRepository->query()->whereNull('viewed_at')->count();
        $articles = $this->articleRepository->query()->count();

        return view('admin.dashboard',compact('activeWebsite','activeIntro','unreadInquiry','articles'));
    }
}
