<?php

namespace App\Http\Controllers;

use App\News;
use App\Article;
use App\Service;
use App\Traits\ServiceTrait;
use Illuminate\Http\Request;
use App\Http\Repositories\NewsRepository;
use App\Http\Repositories\ReviewRepository;
use App\Http\Repositories\ArticleRepository;
use App\Http\Repositories\InquiryRepository;
use App\Http\Repositories\ServiceRepository;
use App\Http\Repositories\MyWebsiteRepository;
use App\Http\Repositories\ServiceCategoryRepository;

class PageLandingController extends Controller
{
    public $myWebsiteRepository,$inquiryRepository,$serviceRepository, $serviceCategoryRepository, $articleRepository, $reviewRepository, $newsRepository;
    use ServiceTrait;

    public function __construct()
    {
        $this->myWebsiteRepository = app(MyWebsiteRepository::class);
        $this->inquiryRepository = app(InquiryRepository::class);
        $this->serviceRepository = app(ServiceRepository::class);
        $this->serviceCategoryRepository = app(ServiceCategoryRepository::class);
        $this->articleRepository = app(ArticleRepository::class);
        $this->reviewRepository = app(ReviewRepository::class);
        $this->newsRepository = app(NewsRepository::class);
    }

    public function index()
    {
        $activeTemplate = $this->myWebsiteRepository->query()->with('contents')->whereActive(1)->first() ?? null;
        $featuredReviews = collect();
        if($activeTemplate){
            $contents = [];
            foreach($activeTemplate->contents as $content){
                $contents[$content->content_code] = collect(json_decode($content->data));
            }
            $featuredReviews = $this->reviewRepository->query()->with('service:id,name,icon,slug')
            ->where('rating','>', 3)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        }else{
            abort(503);
        }

        return view('landing.template-1.index',compact('contents','featuredReviews'));
    }

    public function saveInquiry(Request $request)
    {

        $data = [
            'name'           => $request->name,
            'email'          => $request->email,
            'description'    => $request->description,
            'service_id'     => $request->service_id ?? null,
            'contact'        => $request->contact,
        ];

        $this->inquiryRepository->save($data);
        return redirect()->back()->with('success', 'Inquiry sent! Please make your contact available as our team will reach you soon. Thank you!');
    }

    public function showCatalog(Request $request)
    {
        $activeTemplate = $this->myWebsiteRepository->query()->with('contents')->whereActive(1)->first() ?? null;

        if($activeTemplate){
            $keyword = $request->keyword ?? null;

            $grouped = $this->serviceRepository->query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('description_clean', 'like', '%' . $keyword . '%');
            })
            ->whereNotNull('category_id')
            ->whereNotNull('published_at')
            ->select('id','name','description','description_clean','published_at','category_id','icon','slug','type')
            ->get()
            ->groupBy('category_id');

            $categories = $this->serviceCategoryRepository->query()->select('id','name','description')
            ->has('services')->get()->keyBy('id');

            return view('landing.template-1.catalog.services',compact('grouped','keyword','categories'));
        }else{
            abort(503);
        }

    }

    public function showService(Service $service)
    {

        $categories = $this->serviceCategoryRepository->query()
        ->has('services')
        ->whereNotNull('published_at')
        ->select('id','name','description','published_at')
        ->get();

        $service->tags = explode(',', $service->tags);
        $service->load('category','articles:id,name,slug,thumbnail,service_id,description','reviews:id,comment,commented_by,rating,service_id,created_at');

        $reviewArray = $service->reviews->pluck('rating')->toArray();
        $averageReview = !$reviewArray ? 0 : $this->fetchAverageRating($reviewArray);

        return view('landing.template-1.catalog.show',compact('service','categories','averageReview'));
    }

    public function saveReview(Request $request)
    {

        $data = [
            'comment'        => $request->comment,
            'commented_by'   => $request->commented_by ?? 'Client',
            'service_id'     => $request->service_id,
            'rating'         => $request->rating,
        ];

        $this->reviewRepository->save($data);
        return redirect()->back()->with('success', 'Review added! Thank you for the feedback!');
    }

    public function showArticleList(Request $request)
    {
        $activeTemplate = $this->myWebsiteRepository->query()->with('contents')->whereActive(1)->first() ?? null;
        if($activeTemplate){
            $keyword = $request->keyword ?? null;
            $articles = $this->articleRepository->query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'DESC')
            ->paginate(10);
            return view('landing.template-1.articles.list',compact('articles','keyword'));
        }else{
            abort(503);
        }

    }

    public function showArticle(Article $article)
    {
        $article->load('service');
        $reviewArray = $article->service ? $article->service->reviews->pluck('rating')->toArray() : [];
        $averageReview = !$reviewArray ? 0 : $this->fetchAverageRating($reviewArray);
        return view('landing.template-1.articles.show',compact('article','averageReview'));
    }

    public function showNewsList(Request $request)
    {
        $activeTemplate = $this->myWebsiteRepository->query()->with('contents')->whereActive(1)->first() ?? null;
        if($activeTemplate){
            $newsEvents = $this->newsRepository->query()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'DESC')
            ->select('id','name','slug','description','thumbnail','headline','created_at','published_at')
            ->paginate(10);

            return view('landing.template-1.news_events.list',compact('newsEvents'));
        }
        else{
            abort(503);
        }

    }

    public function showNews(News $news)
    {

        return view('landing.template-1.news_events.show',compact('news'));
    }

}
