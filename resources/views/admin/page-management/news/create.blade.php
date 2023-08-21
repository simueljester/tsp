@extends('layouts.app-soft-ui')
@section('content')

<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-earth-asia"></i> News </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.news.index')}}"> List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><strong> Add News </strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 ">
            <form method="post" action="{{route('admin.pages.news.save')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3 fadeIn " >
                    <div class="card-header bg-light">
                       <strong> Add News </strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-control-label">Headline</label><small class="text-danger"> * </small>
                            <input type="text" name="headline" id="headline" class="form-control " value="{{ old('headline') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                            <input type="text" name="name" id="name" class="form-control " onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Slug</label><small class="text-danger"> * </small>
                            <input type="text" name="slug" id="slug-text" class="form-control bg-light" readonly value="{{ old('slug') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                            <textarea type="text" name="description" id="description" class="form-control description" rows="10"> {!! old('description') !!} </textarea>
                        </div>
                        <div class="form-group">
                            <div class="mt-2 mb-2">
                                <img id="outputImage" class="border-custom shadow" style="width: 200px;height:150px;object-fit: cover;" />
                            </div>
                            <label class="form-control-label">Thumbnail</label> <small class="text-danger"> * </small>
                            <input type="file" class="form-control" name="thumbnail" accept="image/*" onchange="loadFile(event)" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"> Tags </label>
                            <input class="tag-input" />
                            <div>
                                <small> For search function; Input new tag by pressing "Enter" after typing the keyword or select from the existing list by typing the name </small>
                            </div>
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
                        <input type="hidden" name="multimedia" id="multimedia">
                        <button class="btn btn-sm btn-primary"> Save </button>
                        <a href="{{route('admin.pages.news.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            <div class="card mt-3 fadeIn">
                <div class="card-header bg-light">
                    <strong>Upload Images / Videos</strong>
                </div>
                <div class="card-body">
                    <div class="form-group mt-3">
                        <form method="post" action="{{route('admin.dropzone.store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                            @csrf
                            <div class="dz-message fadeInDown" data-dz-message>
                                <h2><i class="fa-solid fa-cloud-arrow-up fa-fade fa-lg"></i></h2>
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
@include('scripts-tag')
@include('scripts-dropzone')
@include('scripts-slick')
@include('scripts-ck-editor')

<script>

    function loadFile(event) {
        let output = document.getElementById('outputImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        $('#outputImage').show()
    }

    $( document ).ready(function() {
       $('#outputImage').hide()
    });

    function convertToSlug( str ) {
        str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
        str = str.replace(/^\s+|\s+$/gm,'');
        str = str.replace(/\s+/g, '-');
        $( "#slug-text" ).val(str);
    }

    createTag()

</script>

@endsection

