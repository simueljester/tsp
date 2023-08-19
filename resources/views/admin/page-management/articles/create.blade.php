@extends('layouts.app-soft-ui')


@section('content')

<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-regular fa-newspaper"></i> Articles </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.articles.index')}}">List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> <strong> Add New Article </strong></li>
                </ol>
            </nav>
        </div>
  </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('admin.pages.articles.save')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="card fadeIn mt-3">
                    <div class="card-header bg-light">
                        <strong> Add New Article </strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                            <input type="text" name="name" id="name" class="form-control " onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Slug</label><small class="text-danger"> * </small>
                            <input type="text" name="slug" id="slug-text" class="form-control bg-light" readonly value="{{ old('slug') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                            <textarea type="text" name="description" id="description" class="form-control description" rows="10"> Type your intro description here </textarea>
                        </div>
                        <div class="form-group">
                            <div class="mt-2 mb-2">
                                <img id="outputImage" class="border-custom shadow" style="width: 200px;height:150px;" />
                            </div>
                            <label class="form-control-label">Thumbnail</label> <small class="text-danger"> * </small>
                            <input type="file" class="form-control" name="thumbnail" accept="image/*" onchange="loadFile(event)" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">Publish</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1" {{old('publish') == '1' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">Is Featured</label> <small> Display in homepage </small>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{old('is_featured') == '1' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button  class="btn btn-sm btn-primary"> Save </button>
                        <a href="{{route('admin.pages.articles.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-ck-editor')

<script>

    // A $( document ).ready() block.
    $( document ).ready(function() {
       $('#outputImage').hide()
    });
    function convertToSlug( str ) {
        str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
        str = str.replace(/^\s+|\s+$/gm,'');
        str = str.replace(/\s+/g, '-');
        $( "#slug-text" ).val(str);
    }

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
