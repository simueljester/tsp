<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ReviewRepository;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public $reviewRepository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->reviewRepository = app(ReviewRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reviews = $this->reviewRepository->query()->with('service:id,name,icon,slug')->paginate(10);
        return view('admin.page-management.reviews.index',compact('reviews'));
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
    public function save()
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        try {
            $this->reviewRepository->delete($request->deleteId);
            return redirect()->route('admin.pages.reviews.index')->with('success', 'Review successfully deleted');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }
}
