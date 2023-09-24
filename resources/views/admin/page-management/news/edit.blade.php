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
                    <li class="breadcrumb-item active" aria-current="page"><strong> {{$news->name}} </strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 ">
            <form method="post" action="{{route('admin.pages.news.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3 fadeIn " >
                    <div class="card-header bg-light">
                       <strong> Edit News </strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-control-label">Headline</label><small class="text-danger"> * </small>
                            <input type="text" name="headline" id="headline" class="form-control " value="{{ $news->headline }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                            <input type="text" name="name" id="name" class="form-control " onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" value="{{ $news->name }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Slug</label><small class="text-danger"> * </small>
                            <input type="text" name="slug" id="slug-text" class="form-control bg-light" readonly value="{{ $news->slug }}">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                            <textarea type="text" name="description" id="description" class="form-control description" rows="10"> {!! $news->description !!} </textarea>
                        </div>

                        <div class="form-group">
                            <div class="mt-2 mb-2">
                                <img id="outputImage" src="{{asset('images/icons').'/'.$news->thumbnail}}" class="border-custom shadow" style="width: 200px;height:150px;" />
                            </div>
                            <label class="form-control-label">Thumbnail</label> <small class="text-danger"> * </small>
                            <input type="file" class="form-control" name="thumbnail" accept="image/*" onchange="loadFile(event)">
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
                                        <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1" {{$news->published_at ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" hidden>
                                <div class="form-group">
                                    <label class="form-control-label">Is Featured</label> <small> Display in homepage </small>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{$news->is_featured ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"> <i class="fa-brands fa-youtube text-danger"></i> Embed Youtube </label>
                            <textarea name="youtube" id="youtube" class="form-control bg-light" cols="30" rows="5"> {{$news->youtube_embed}} </textarea>
                            <small style="cursor: pointer;" onclick="showEmbedInfo()" class="text-primary"> <i class="fa-solid fa-circle-info"></i> How to embed? </small>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" id="id" value="{{$news->id}}">
                        <input type="hidden" name="multimedia" id="multimedia">
                        <button class="btn btn-sm btn-primary"> Save Changes</button>
                        <a href="{{route('admin.pages.news.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            @if ($news->multimedia)
                <div class="card mt-3 fadeIn">
                    <div class="card-header bg-light">
                        <strong>Uploaded</strong>
                    </div>
                    <div class="card-body">
                        <div class="scrolling-wrapper">
                            @foreach (json_decode($news->multimedia,true) as $media)
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
    <form action="{{route('admin.pages.news.remove-image')}}" method="post">
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
                            Are you sure you want to remove this image from <strong> {{$news->name}} </strong> ?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="newsId" id="newsId" value="{{$news->id}}">
                        <input type="hidden" name="multimediaName" id="multimediaName">
                        <button class="btn btn-primary"> Confirm Remove </button>
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
     </form>

     <div class="modal fade" id="howToEmbedYoutube" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Embed Youtube Video </h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-left">
                <ul>
                    <li> Go to <a href="https://www.youtube.com/" target="_blank" class="text-primary"> Youtube.com </a> </li>
                    <li> Find the video you want to embed and <strong> right click </strong> on a video </li>
                    <li> Select <strong> <> Copy embed code </strong> </li>
                    <li> You can modify the iframe source <strong> width </strong> and <strong> height </strong> </li>
                    <li> Standard size is  560 pixels width and 315 pixels height </li>
                </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
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

     // fetching and displaying tags
    var existing_tags = {!! $news->toJson() !!};
    if(existing_tags.tags){
        fetchTag()
    }else{
        createTag()
    }

    function fetchTag(){
        const arr_tags = existing_tags.tags.split(',');
        const collected_tags = []

        arr_tags.forEach(function (tag, i) {
            collected_tags.push({id:i,name:tag})
        });

        editTag(collected_tags)
    }

    function loadFile(event) {
        let output = document.getElementById('outputImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        $('#outputImage').show()
    }

    function convertToSlug( str ) {
        str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
        str = str.replace(/^\s+|\s+$/gm,'');
        str = str.replace(/\s+/g, '-');
        $( "#slug-text" ).val(str);
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

    function showEmbedInfo(){
        $('#howToEmbedYoutube').modal('show')
    }

</script>

@endsection

