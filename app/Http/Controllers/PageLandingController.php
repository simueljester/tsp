<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MyWebsiteRepository;
use Illuminate\Http\Request;

class PageLandingController extends Controller
{
    public $myWebsiteRepository;

    public function __construct()
    {
        $this->myWebsiteRepository = app(MyWebsiteRepository::class);
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
}
