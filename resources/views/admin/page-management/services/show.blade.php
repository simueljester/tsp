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
    <div class="card mt-3">
        <div class="card-header">
            <h3>
                <div class="border-custom-circle text-center custom-icon-parent-2 bg-light shadow target-icon mb-3">
                    <h1> <i class="{{$service->icon}} custom-icon-child-2" id="showicon"></i> </h1>
                </div>
                {{$service->name}}
            </h3>
            <hr class="horizontal dark my-1">
            <div> <small> <strong> Category: </strong> {{$service->category->name}} </small> </div>
            @if ($service->type == 'service')
                <div> <small> <strong> Type: </strong> Service</small> </div>
            @else
                <div> <small> <strong> Type: </strong> Product</small> </div>
            @endif
            @if ($service->published_at)
                <div> <small> <strong> Publication Date: </strong> {{$service->published_at->format('m-d-Y')}}</small> </div>
            @endif
            @if ($service->created_at == $service->updated_at)
                <small> <strong> Creation: </strong> {{$service->created_at->format('m-d-Y')}} </small>
            @else
                <small> <strong> Last Updated: </strong> {{$service->updated_at->format('m-d-Y')}} </small>
            @endif
        </div>
        <div class="card-body">
            <div> {!! $service->description !!} </div>
            @if ($service->multimedia)
                <div>
                    <strong>Gallery</strong>
                    <div class="mt-2">
                        <div class="multiple-slider">
                            @foreach (json_decode($service->multimedia,true) as $media)
                            <div class="card-hover-scale" style="cursor: pointer;" onclick="viewGallery({{json_encode($media)}})">
                                <img class="card-img-top" src="{{asset('/images/dropzone').'/'.$media}}" style="max-height:250px;max-width:250px;">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer bg-light">
            <a href="#" class="btn btn-sm btn-primary"> Manage Category </a>
            <a href="{{route('admin.pages.services.edit',$service)}}" class="btn btn-sm btn-outline-secondary"> Edit </a>
            <a href="#" class="btn btn-sm btn-outline-secondary"> Delete </a>
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

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-slick')
<script>
    function viewGallery(media){
        $('#viewGalleryModal').modal('show')
        let imgSrc = '/images/dropzone/' +media;
        $('#image').attr('src', imgSrc);
    }
</script>
@endsection
