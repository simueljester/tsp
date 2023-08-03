@extends('layouts.app-soft-ui')
@section('content')

<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-cube"></i> Services </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.services.categories.index')}}"> Category List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('admin.pages.services.index',$category)}}">{{$category->name}} Service</a> </li>
                    <li class="breadcrumb-item active" aria-current="page"><strong> Add Service </strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form method="post" action="{{route('admin.pages.services.save')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3 fadeIn">
                    <div class="card-header bg-light">
                        <strong class="text-capitalize"> <i class="{{$category->icon}}"></i> {{$category->name}} </strong> <i class="fa-solid fa-angles-right"></i> Add Service
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="text-center mt-3">
                                <img id="output" class="border-custom-circle shadow" src="{{url('/images/thumbnail-default.png')}}" style="width:150px;height:150px;"/>
                            </div>
                            <label class="form-control-label">Thumbnail</label> <small class="text-danger"> * </small>
                            <div class="input-group mb-3">
                                <button class="btn btn-primary mb-0" type="button" id="getFile">Browse</button>
                                <input type="text" class="form-control"  placeholder="  Select image" id="thumbnailImage"  required readonly>
                                <input type="file" name="thumbnail" accept="image/*" id="thumbnailFile" onchange="loadFile(event)" hidden>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                            <input type="text" name="name" id="name" class="form-control " onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Slug</label><small class="text-danger"> * </small>
                            <input type="text" name="slug" id="slug-text" class="form-control bg-light" readonly value="{{ old('slug') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Type</label><small class="text-danger"> * </small>
                            <select name="type" id="type" class="form-control">
                                <option value="service" {{old('type') == 'service' ? 'checked' : '' }}>Service</option>
                                <option value="product" {{old('type') == 'product' ? 'checked' : '' }}>Product</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                            <textarea type="text" name="description" id="description" class="form-control description" rows="10"> {!! old('description') !!} </textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Publish</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1" {{old('publish') == '1' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="category_id" id="category_id" value="{{$category->id}}">
                        <input type="hidden" name="multimedia" id="multimedia">
                        <button class="btn btn-sm btn-primary" name="save" value="1"> Save </button>
                        <button class="btn btn-sm btn-outline-primary" name="save" value="2"> Save & New </button>
                        <a href="{{route('admin.pages.services.index',$category)}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <strong>Additional Media</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label"></label>
                        <form method="post" action="{{route('admin.dropzone.store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                            @csrf
                            <div class="dz-message fadeInDown" data-dz-message>
                                <h3><i class="fa-solid fa-cloud-arrow-up fa-fade fa-lg"></i></h3>
                                <span>Drop your files here</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<style>

</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-slick')
@include('scripts-ck-editor')
@include('scripts-dropzone')
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        $('#thumbnailImage').val(event.target.files[0].name)
        $( "#output" ).show();
    };

    $("#getFile").click(function(){
        $( "#thumbnailFile" ).trigger( "click" );
    });

    function convertToSlug( str ) {
        //replace all special characters | symbols with a space
        str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
        // trim spaces at start and end of string
        str = str.replace(/^\s+|\s+$/gm,'');
        // replace space with dash/hyphen
        str = str.replace(/\s+/g, '-');
        $( "#slug-text" ).val(str);
    }

</script>

@endsection

