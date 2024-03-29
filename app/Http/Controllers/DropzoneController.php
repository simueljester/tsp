<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    //
    public function store(Request $request){
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/dropzone'),$imageName);
        return response()->json(['success'=>$imageName]);
    }
}
