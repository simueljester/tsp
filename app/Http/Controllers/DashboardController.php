<?php

namespace App\Http\Controllers;

use App\Traits\ServiceTrait;
use Illuminate\Http\Request;
use App\Http\Repositories\NewsRepository;
use App\Http\Repositories\ReviewRepository;
use App\Http\Repositories\ArticleRepository;
use App\Http\Repositories\InquiryRepository;
use App\Http\Repositories\ServiceRepository;
use App\Http\Repositories\MyWebsiteRepository;
use App\Http\Repositories\MyWebsiteContentRepository;

class DashboardController extends Controller
{
    public $mywebsiteRepository, $mywebsiteContentRepository, $articleRepository, $newsRepository, $serviceRepository, $inquiryRepository;
    public $reviewRepository;
    use ServiceTrait;
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
        $this->reviewRepository = app(ReviewRepository::class);
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
        $unreadReviews = $this->reviewRepository->query()->whereNull('viewed_at')->count();
        $articles = $this->articleRepository->query()->count();

        $topServices = $this->serviceRepository->query()->with('reviews:id,service_id,rating')->select('id','name','slug','type','icon')->get();
        $topServices->map(function ($service){
            $reviewArray = $service->reviews->pluck('rating')->toArray();
            $service['rating'] = !$reviewArray ? 0 : $this->fetchAverageRating($reviewArray);
            return $service;
        });
        $topServices = $topServices->sortByDesc('rating')->take(5);

        return view('admin.dashboard',compact('activeWebsite','activeIntro','unreadInquiry','unreadReviews','articles','topServices'));
    }
}
