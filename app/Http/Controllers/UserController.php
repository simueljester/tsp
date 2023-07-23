<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\UserRepository;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

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
    public function index(Request $request){
        $status = $request->status ?? 'active';
        $users = app(UserRepository::class)->query()
        ->when($status == 'archive', function ($q, $search) {
                $q->whereNotNull('archived_at');
        })
        ->when($status == 'active', function ($q, $search) {
                $q->whereNull('archived_at');
        })
        ->get();
        return view('admin.users.list',compact('users','status'));
    }

    public function create(){
        $status = null;
        return view('admin.users.create',compact('status'));
    }

    public function save(Request $request){
        $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);

        $data = [
            'name'        => $request->name,
            'email'       => $request->email,
            'role'        => $request->role,
            'password'    => Hash::make($request->password)
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

    public function show(User $user){
        $status = null;
        return view('admin.users.show',compact('user','status'));
    }

    public function edit(User $user){
        $status = null;
        return view('admin.users.edit',compact('user','status'));
    }

    public function update(Request $request){

        $request->validate([
            'email'                 => ['required',Rule::unique('users')->ignore($request->id)],
            'role'                  => 'required',
        ]);

        $user = User::find($request->id);
        if($user){
                $data = [
                'name'        => $request->name,
                'email'       => $request->email,
                'role'        => $request->role,
                'password'              => $request->password ? Hash::make($request->password) : $user->password
            ];

            try {
                app(UserRepository::class)->update($request->id,$data);
                return redirect()->route('admin.users.index')->with('success', 'User successfully updated');
            }
            //catch exception
            catch(\Exception $e) {
                return redirect()->route('admin.users.create')->with('error', 'Unable to update');
            }
        }else{
            return redirect()->route('admin.users.index')->with('error', 'User not found!');
        }

    }

    public function archive($user){
        app(UserRepository::class)->archive($user);
        return redirect()->route('admin.users.index')->with('success', 'User archived!');
    }

    public function setToActive($user){
        app(UserRepository::class)->archiveRemove($user);
        return redirect()->back()->with('success', 'User set to active!');
    }
}
