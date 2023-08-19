<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Repositories\ArticleRepository;

class ArticleController extends Controller
{
       //
    public $articleRepository;
       /**
        * Create a new controller instance.
        *
        * @return void
        */
    public function __construct()
    {
        $this->middleware('auth');
        $this->articleRepository = app(ArticleRepository::class);
    }
    public function index()
    {
        //
        return view('admin.page-management.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.page-management.articles.create');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
