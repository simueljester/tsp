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
            <form action="{{route('admin.pages.introduction.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <strong> Edit Template </strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="mt-2 mb-2">
                                <img id="outputImage" src="{{asset('images/icons').'/'.$introduction->logo}}" class="border-custom shadow" style="width: 200px;height:150px;object-fit:contain" />
                            </div>
                            <label class="form-control-label">Logo </label> <small class="text-danger"> * </small>
                            <input type="file" class="form-control" name="logo" accept="image/*" onchange="loadFile(event)">
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="form-control-label">Title</label> <small class="text-danger"> * </small>
                                    <input type="text" name="title" id="title" class="form-control" value="{{$introduction->title}}" placeholder="Technology Solutions Provider & Consultancy" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label">Slogan</label><small class="text-danger"> * </small>
                                    <input type="text" name="slogan" id="slogan" class="form-control" value="{{$introduction->slogan}}" placeholder="We do it with Passion" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                            <textarea type="text" name="description" id="description" class="form-control description" rows="10"> {!! $introduction->description !!} </textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Breaker</label> <small class="text-danger"> * </small>
                            <input type="text" name="breaker" id="breaker" class="form-control" placeholder="TSP"  value="{{$introduction->breaker}}" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" id="id" value="{{$introduction->id}}">
                        <button class="btn btn-sm btn-primary"> Save Changes </button>
                        <a href="{{route('admin.pages.introduction.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-ck-editor')
<script>

    var loadFile = function(event) {
        var output = document.getElementById('outputImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        $('#outputImage').show()
    };
</script>
@endsection
