<?php

namespace App\Http\Controllers;

use App\Http\Repositories\InquiryRepository;
use App\Http\Repositories\MyWebsiteRepository;
use App\Http\Repositories\ServiceCategoryRepository;
use App\Http\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class PageLandingController extends Controller
{
    public $myWebsiteRepository,$inquiryRepository,$serviceRepository, $serviceCategoryRepository;

    public function __construct()
    {
        $this->myWebsiteRepository = app(MyWebsiteRepository::class);
        $this->inquiryRepository = app(InquiryRepository::class);
        $this->serviceRepository = app(ServiceRepository::class);
        $this->serviceCategoryRepository = app(ServiceCategoryRepository::class);
    }

    public function index(){
        $activeTemplate = $this->myWebsiteRepository->query()->with('contents')->whereActive(1)->first() ?? null;

        if($activeTemplate){
            $contents = [];
            foreach($activeTemplate->contents as $content){
                $contents[$content->content_code] = collect(json_decode($content->data));
            }
        }else{
            abort(404);
        }
        // dd($contents);
        return view('landing.template-1.index',compact('contents'));
    }

    public function saveInquiry(Request $request){

        $data = [
            'name'           => $request->name,
            'email'          => $request->email,
            'description'    => $request->description,
            'service_id'     => null,
            'contact'        => $request->contact,
        ];

        $this->inquiryRepository->save($data);
        return redirect()->back()->with('success', 'Inquiry sent! Please make your contact available as our team will reach you soon. Thank you!');
    }

    public function showCatalog(Request $request){

        $categories = $this->serviceCategoryRepository->query()
        ->with('services:id,name,description_clean,category_id,icon,slug,type')
        ->whereNotNull('published_at')
        ->select('id','name','description','published_at')
        ->get();

        // dd($categories);

        return view('landing.template-1.catalog.services',compact('categories'));
    }
}
