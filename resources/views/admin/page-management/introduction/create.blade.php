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
              <li class="breadcrumb-item"><a href="{{route('admin.pages.introduction.index')}}">List</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.pages.introduction.create')}}"> <strong> Add Template </strong> </a></li>
            </ol>
        </nav>
    </div>
  </div>

    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('admin.pages.introduction.save')}}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <strong> Add New Template </strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <strong>Title</strong> <small class="text-danger"> * </small>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Technology Solutions Provider & Consultancy" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <strong>Slogan</strong> <small class="text-danger"> * </small>
                                    <input type="text" name="slogan" id="slogan" class="form-control" placeholder="We do it with Passion" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong>Description</strong> <small class="text-danger"> * </small>
                            <textarea type="text" name="description" id="description" class="form-control description" rows="10"> Type your intro description here </textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary"> Add </button>
                        <a href="{{route('admin.pages.introduction.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>

    </div>


</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-ck-editor')


@endsection
