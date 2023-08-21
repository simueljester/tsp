<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use Illuminate\Validation\Rule;
use App\Http\Repositories\ArticleRepository;
use App\Http\Repositories\ServiceRepository;

class ArticleController extends Controller
{
       //
    public $articleRepository,$serviceRepository;
       /**
        * Create a new controller instance.
        *
        * @return void
        */
    public function __construct()
    {
        $this->middleware('auth');
        $this->articleRepository = app(ArticleRepository::class);
        $this->serviceRepository = app(ServiceRepository::class);
    }
    public function index()
    {
        //
        $articles = $this->articleRepository->query()->select('id','name','published_at','is_featured')->paginate(10);
        return view('admin.page-management.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $services = $this->serviceRepository->query()->select('id','name')->get();
        return view('admin.page-management.articles.create',compact('services'));
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
            'name'          => 'required',
            'description'   => 'required',
            'slug'          => 'required|unique:articles,slug|max:191'
        ]);


        $thumbnail = $request->thumbnail ? UploadHelper::uploadFile($request->thumbnail) : null;

        $data = [
            'name'              => ucwords($request->name),
            'slug'              => $request->slug,
            'description'       => $request->description,
            'thumbnail'         => $thumbnail,
            'service_id'        => $request->service_id,
            'is_featured'       => $request->is_featured ? true : false,
            'published_at'      => $request->publish ? now() : null,
        ];

        try {
            $this->articleRepository->save($data);
            return redirect()->route('admin.pages.articles.index')->with('success', 'Article successfully save');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
        return view('admin.page-management.articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
        $services = $this->serviceRepository->query()->select('id','name')->get();
        return view('admin.page-management.articles.edit',compact('article','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'slug'          => ['required',Rule::unique('services')->ignore($request->id)]
        ]);


        $thumbnail = $request->thumbnail ? UploadHelper::uploadFile($request->thumbnail) : Article::whereId($request->id)->first()->thumbnail;

        $data = [
            'name'              => ucwords($request->name),
            'slug'              => $request->slug,
            'description'       => $request->description,
            'thumbnail'         => $thumbnail,
            'service_id'        => $request->service_id ?? null,
            'is_featured'       => $request->is_featured ? true : false,
            'published_at'      => $request->publish ? now() : null,
        ];

        try {
            $this->articleRepository->update($request->id,$data);
            return redirect()->route('admin.pages.articles.index')->with('success', 'Article successfully save');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
        try {
            $this->articleRepository->delete($request->deleteId);
            return redirect()->route('admin.pages.articles.index')->with('success', 'Article successfully deleted');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }
}
