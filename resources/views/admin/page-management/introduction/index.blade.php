@extends('layouts.app-soft-ui')

@section('content')
<div>
  <div class="card">
    <div class="card-body">
        <div>
            <h4 class="mt-3"> <i class="fa-solid fa-cube"></i> Introduction </h4> 
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.pages.introduction.index')}}"> <strong> List </strong> </a></li>
            </ol>
        </nav>          
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-sm-6">
        <div class="card fadeInLeft">
            <div class="card-header">
                <strong> View Introduction </strong>
            </div>
            <div class="card-body">
                test
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card fadeInRight">
            <div class="card-header">
                <strong> Template List </strong>
                <div class="mt-3">
                    <a href="{{route('admin.pages.introduction.create')}}" class="btn btn-primary btn-sm"> <i class="fa-solid fa-plus"></i> Add Template  </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <th> ID </th>
                        <th> Title </th>
                        <th> Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td> # </td>
                            <td> Test Title </td>
                            <td>
                                <button class="btn btn-success"> <i class="fa-solid fa-eye"></i> </button> 
                                <button class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> </button> 
                                <button class="btn btn-danger"> <i class="fa-solid fa-trash"></i> </button> 
                            </td>
                        </tr>
                        <tr>
                            <td> # </td>
                            <td> Test Title </td>
                            <td>
                                <button class="btn btn-success"> <i class="fa-solid fa-eye"></i> </button> 
                                <button class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> </button> 
                                <button class="btn btn-danger"> <i class="fa-solid fa-trash"></i> </button> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
