@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-circle-info"></i> About </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.about.index')}}">List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> <strong> Add New About </strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{route('admin.pages.about.save')}}" method="POST">
        @csrf
        <div class="card fadeIn mt-3">
            <div class="card-header bg-light">
                <strong> Add New About </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-control-label">Title</label><small class="text-danger"> * </small>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                    <textarea type="text" name="description" id="description" class="form-control description" rows="10"> Type your description here </textarea>
                </div>
            </div>
            <div class="card-footer">
                <button  class="btn btn-sm btn-primary"> Save </button>
                <a href="{{route('admin.pages.about.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
            </div>
        </div>
    </form>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-ck-editor')
<script>

</script>
@endsection
