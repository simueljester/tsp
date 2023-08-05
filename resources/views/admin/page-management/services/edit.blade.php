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
                    <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('admin.pages.services.index',$service->category->id)}}">{{$service->category->name}} </a> </li>
                    <li class="breadcrumb-item active" aria-current="page"><strong> {{$service->name}}</strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 ">
            <form method="post" action="{{route('admin.pages.services.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3 fadeIn " >
                    <div class="card-header bg-light">
                        <strong class="text-capitalize"> {{$service->category->name}} </strong> <i class="fa-solid fa-angles-right"></i> {{$service->name}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group ">
                                    <div class="border-custom-circle text-center custom-icon-parent bg-light shadow">
                                        <h1> <i class="{{$service->icon}} custom-icon-child" id="showicon"></i> </h1>
                                    </div>
                                </div>
                                <div class="form-group" hidden>
                                    <label class="form-control-label">Icon</label> <small class="text-danger"> * </small>
                                    <input type="text" name="icon" id="icon" class="form-control bg-light" readonly value="{{$service->icon}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                            <input type="text" name="name" id="name" class="form-control " onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" value="{{$service->name}}">
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
                            <input type="text" name="slug" id="slug-text" class="form-control bg-light" readonly value="{{$service->slug}}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Type</label><small class="text-danger"> * </small>
                            <select name="type" id="type" class="form-control">
                                <option value="service" {{$service->type == 'service' ? 'Selected' : '' }}>Service</option>
                                <option value="product" {{$service->type == 'product' ? 'Selected' : '' }}>Product</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                            <textarea type="text" name="description" id="description" class="form-control description" rows="10"> {!! $service->description !!} </textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Publish</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1" {{$service->published_at ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" id="id" value="{{$service->id}}">
                        <input type="hidden" name="category_id" id="category_id" value="{{$service->category->id}}">
                        <input type="hidden" name="multimedia" id="multimedia">
                        <button class="btn btn-sm btn-primary" name="save"> Save </button>
                        <a href="{{route('admin.pages.services.index',$service->category->id)}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            @if ($service->multimedia)
                <div class="card mt-3 fadeIn">
                    <div class="card-header bg-light">
                        <strong>Uploaded</strong>
                    </div>
                    <div class="card-body">
                        <div class="scrolling-wrapper">
                            @foreach (json_decode($service->multimedia,true) as $media)
                            <div class="card-scroll-x border-custom" style="cursor: pointer;">
                                <img class="border-custom card-hover-outline" src="{{asset('/images/dropzone').'/'.$media}}" style="height:180px;width:250px;"  onclick="viewGallery({{json_encode($media)}})">
                                <div class="mt-1">
                                    <a href="javascript:;" class="btn btn-sm btn-secondary" onclick="removeImageConfirmation({{json_encode($media)}})">Remove</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
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

    {{-- Modal view image --}}
    <div class="modal fade" id="viewGalleryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <img src="" id="image" style="width: 100%;max-height: 650px;object-fit: contain;" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

     {{-- Modal remove image confirmation--}}
     <form action="{{route('admin.pages.services.remove-image')}}" method="post">
        @csrf
        <div class="modal fade" id="removeImageConfirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <img src="" id="imageConfirmation" style="width: 100%;max-height: 650px;object-fit: contain;" />
                        <div class="mt-3">
                            Are you sure you want to remove this image from <strong> {{$service->name}} </strong> ?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="serviceId" id="serviceId" value="{{$service->id}}">
                        <input type="hidden" name="multimediaName" id="multimediaName">
                        <button class="btn btn-primary"> Confirm Remove </button>
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
     </form>

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

    function viewGallery(media){
        $('#viewGalleryModal').modal('show')
        let imgSrc = '/images/dropzone/' +media;
        $('#image').attr('src', imgSrc);
    }

    function removeImageConfirmation(media){
        $('#removeImageConfirmationModal').modal('show')
        let imgSrc = '/images/dropzone/' +media;
        $('#imageConfirmation').attr('src', imgSrc);
        $('#multimediaName').val(media)
    }

</script>


@endsection

