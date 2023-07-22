<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntroductionController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.page-management.introduction.index');
    }

    public function create(){
        return view('admin.page-management.introduction.create');
    }

    public function save(Request $request){

        $request->validate([
            'title' => 'required|unique:users,email',
            'description' => 'required|confirmed'
        ]);

        $data = [
            'title'        => $request->name,
            'description'  => $request->email
        ];

        try {
            app(UserRepository::class)->save($data);
            return redirect()->route('admin.users.index')->with('success', 'User successfully added');
        }
        //catch exception
        catch(\Exception $e) {
            return redirect()->route('users.create')->with('error', 'Unable to create');
        }
    }
}
