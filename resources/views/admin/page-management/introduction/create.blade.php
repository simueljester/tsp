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

  <form action="" method="POST">
    @csrf
    <div class="card mt-3">
        <div class="card-header bg-light">
            <strong> Add New Template </strong> 
        </div>
        <div class="card-body">
            <div class="form-group">
                <strong>Title</strong> <small class="text-danger"> * </small>
                <input type="text" name="title" id="title" class="form-control" placeholder="Technology Solutions Provider & Consultancy" required>
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


@include('scripts')

@endsection