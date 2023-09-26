<?php

namespace App\Http\Controllers;

use App\Http\Repositories\InquiryRepository;
use App\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    //
    public $inquiryRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->inquiryRepository = app(InquiryRepository::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inquiries = $this->inquiryRepository->query()->with('service:id,name,icon')->orderBy('created_at','DESC')->paginate(20);
        return view('admin.inquiries',compact('inquiries'));
    }

    public function delete(Request $request)
    {
        //
        try {
            $this->inquiryRepository->delete($request->deleteId);
            return redirect()->route('admin.inquiry.index')->with('success', 'Inquiry successfully deleted');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Exception occured. Please contact your developer');
        }
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->viewed_at = $inquiry->viewed_at ?? now();
        $inquiry->save();

        $inquiry->load('service');

        return view('admin.show-inquiry',compact('inquiry'));
    }
}
