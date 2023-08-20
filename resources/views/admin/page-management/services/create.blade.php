@extends('layouts.app-soft-ui')
@section('content')

<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-screwdriver-wrench"></i> Services </h4>
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
        <div class="col-sm-8 ">
            <form method="post" action="{{route('admin.pages.services.save')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3 fadeIn " >
                    <div class="card-header bg-light">
                        <strong class="text-capitalize"> {{$category->name}} </strong> <i class="fa-solid fa-angles-right"></i> Add Service
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group ">
                                    <div class="border-custom-circle text-center custom-icon-parent bg-light shadow">
                                        <h1> <i class="fa-brands fa-uncharted custom-icon-child" id="showicon"></i> </h1>
                                    </div>
                                </div>
                                <div class="form-group" hidden>
                                    <label class="form-control-label">Icon</label> <small class="text-danger"> * </small>
                                    <input type="text" name="icon" id="icon" class="form-control bg-light" readonly value="fa-brands fa-uncharted">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                            <input type="text" name="name" id="name" class="form-control " onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <div class="slick-center">
                                @foreach ($icons as $icon)
                                    <div class="text-center card-hover-outline m-3 border-custom p-1" style="cursor: pointer;" onclick="selectIcon({{json_encode($icon)}})">
                                        <h4> <i class="{{$icon}}" id="{{$icon}}"></i> </h4>
                                    </div>
                                @endforeach
                            </div>
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
@include('scripts-dropzone')
@include('scripts-slick')
@include('scripts-ck-editor')

<script>

    function convertToSlug( str ) {
        str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
        str = str.replace(/^\s+|\s+$/gm,'');
        str = str.replace(/\s+/g, '-');
        $( "#slug-text" ).val(str);
    }

    function selectIcon(icon){
        $('#icon').val(icon)
        $('#iconSelectedLabel').html(icon + ' selected')
        $('#showicon').removeClass()
        $('#showicon').addClass(icon + ' fadeIn custom-icon-child')

    }



</script>

@endsection

