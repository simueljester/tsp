<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use Illuminate\Validation\Rule;
use App\Http\Repositories\TagRepository;
use App\Http\Repositories\NewsRepository;

class NewsController extends Controller
{
     //
     public $newsRepository,$tagRepository;
     /**
      * Create a new controller instance.
      *
      * @return void
      */
     public function __construct()
     {
         $this->middleware('auth');
         $this->newsRepository = app(NewsRepository::class);
         $this->tagRepository = app(TagRepository::class);
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = $this->newsRepository->query()
        ->select('id','name','headline','published_at','is_featured','thumbnail','created_at')
        ->orderBy('created_at','DESC')
        ->paginate(10);
        return view('admin.page-management.news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags = $this->tagRepository->query()->select('id','name')->get();
        return view('admin.page-management.news.create',compact('tags'));
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
            'slug'          => 'required|unique:services,slug|max:191',
            'thumbnail'     => 'required',
            'headline'      => 'required'
        ]);

        $tags = $request->tags ? array_values($request->tags) : [];
        $newly_tags =  $request->newly_tags ? array_values($request->newly_tags) : [];
        $store_tags = array_merge($tags,$newly_tags);

        $multimedia = $request->multimedia ? json_encode(explode(',', $request->multimedia)) : null;

        $thumbnail = $request->thumbnail ? UploadHelper::uploadFile($request->thumbnail) : null;

        $data = [
            'name'              => ucwords($request->name),
            'slug'              => $request->slug,
            'thumbnail'         => $thumbnail,
            'headline'          => $request->headline,
            'description'       => $request->description,
            'is_featured'       =>  $request->is_featured ? true : false,
            'published_at'      => $request->publish ? now() : null,
            'multimedia'        => $multimedia,
            'tags'              => implode (", ", $store_tags)
        ];

        $this->tagRepository->saveNewlyCreatedTags($newly_tags);
        $this->newsRepository->save($data);


        return redirect()->route('admin.pages.news.index')->with('success', 'News successfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
        return view('admin.page-management.news.show',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
        $tags = $this->tagRepository->query()->select('id','name')->get();
        return view('admin.page-management.news.edit',compact('news','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'slug'          => ['required',Rule::unique('services')->ignore($request->id)],
            'headline'      => 'required'
        ]);

        $news = $this->newsRepository->find($request->id);

        $existingMediaArr = $news->multimedia ? json_decode($news->multimedia,true) : []; //existing
        $additionalMediaArr = $request->multimedia ? explode(',', $request->multimedia) : []; //additional

        $multimedia = array_merge($existingMediaArr,$additionalMediaArr);
        $multimedia = count($multimedia) != 0 ? json_encode($multimedia) : null;

        $tags = $request->tags ? array_values($request->tags) : [];
        $newly_tags =  $request->newly_tags ? array_values($request->newly_tags) : [];
        $store_tags = array_merge($tags,$newly_tags);

        $thumbnail = $request->thumbnail ? UploadHelper::uploadFile($request->thumbnail) : $news->thumbnail;

        $data = [
            'name'              => ucwords($request->name),
            'slug'              => $request->slug,
            'thumbnail'         => $thumbnail,
            'headline'          => $request->headline,
            'description'       => $request->description,
            'is_featured'       => $request->is_featured ? true : false,
            'published_at'      => $request->publish ? now() : null,
            'multimedia'        => $multimedia,
            'tags'              => implode (", ", $store_tags)
        ];

        $this->tagRepository->saveNewlyCreatedTags($newly_tags);
        $this->newsRepository->update($request->id,$data);


        return redirect()->route('admin.pages.news.index')->with('success', 'News successfully added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        try {
            $this->newsRepository->delete($request->deleteId);
            return redirect()->route('admin.pages.news.index')->with('success', 'News successfully deleted');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    public function removeImage(Request $request)
    {

        $service = $this->newsRepository->find($request->newsId);

        $multimedia = json_decode($service->multimedia,true);

        $newVal = array_filter($multimedia, fn ($m) => $m != $request->multimediaName); //remove from array list

        if(count($newVal) != 0){
            $service->multimedia = json_encode(array_values($newVal));
        }else{
            $service->multimedia = null;
        }

        $service->save();

        return redirect()->back()->with('success','Image successfully removed from this news');

    }
}
