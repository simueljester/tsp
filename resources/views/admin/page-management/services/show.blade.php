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
                    <li class="breadcrumb-item active" aria-current="page">
                        @if($service->category != null)
                            <a href="{{route('admin.pages.services.index',$service->category->id)}}">{{$service->category->name}} </a>
                        @else
                            <a href="{{route('admin.pages.services.index-uncategorized')}}"> Uncategorized List </a>
                        @endif
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><strong> {{$service->name}}</strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card fadeIn mt-3">
        <div class="card-header">
            <h3>
                <div class="border-custom-circle text-center custom-icon-parent-2 bg-light shadow target-icon mb-3">
                    <h1> <i class="{{$service->icon}} custom-icon-child-2" id="showicon"></i> </h1>
                </div>
                {{$service->name}}
            </h3>
            <hr class="horizontal dark my-1">
            <div> <small> <strong> Category: </strong> {{$service->category ? $service->category->name : 'Uncategorize'}} </small> </div>
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
                                <img class="card-img-top border-custom" src="{{asset('/images/dropzone').'/'.$media}}" style="height:200px;width:250px;object-fit: cover;">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @foreach ($service->tags as $tag)
                <span class="badge badge-pill bg-primary" style="border-radius: 20px;">{{$tag}}</span>
            @endforeach
        </div>
        <div class="card-footer bg-light">
            <a href="#" class="btn btn-sm btn-primary" onclick="selectCategory({{$service->id}})"> Manage Category </a>
            @if ($service->category)
                <a href="{{route('admin.pages.services.edit',$service)}}" class="btn btn-sm btn-info"> Edit </a>
            @endif
            <a href="#" class="btn btn-sm btn-outline-secondary" onclick="deleteConfirmation()"> Delete </a>
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

    {{-- Modal confirm delete --}}
    <form action="{{route('admin.pages.services.delete')}}" method="post">
        @csrf
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                  <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fa-solid fa-triangle-exclamation fa-3x text-warning fa-fade"></i>
                    <input type="hidden" name="deleteId" id="deleteId" value="{{$service->id}}">
                    <input type="hidden" name="categoryId" id="categoryId" value="{{$service->category ? $service->category->id : null}}">
                    <p> You are about to delete a service. Are you sure you want to delete <strong> {{$service->name}} </strong> ? </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary"> Confirm </button>
                </div>
              </div>
            </div>
        </div>
    </form>

    {{-- Modal show categories for selection --}}
    <form action="{{route('admin.pages.services.categories.reassign-service')}}" method="post">
        @csrf
        <div class="modal fade" id="selectCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Reassign Service Category </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div>
                        <p> Reassign <strong> {{$service->name}} to: </strong> </p>
                    </div>
                    <div class="row mt-3">
                        @forelse ($categories as $category)
                        <div class="col-sm-12">
                            <button value="{{$category->id}}" name="categoryId" class="btn {{$service->category->id == $category->id ? 'btn-primary' : 'btn-outline-primary' }} btn-sm w-100" {{$service->category->id == $category->id ? 'disabled' : '' }}> {{$category->name}} </button>
                        </div>
                        @empty
                        <div>
                            No record found
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="selectedServices" id="selectedServices">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    </form>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-slick')
<script>
    function viewGallery(media){
        $('#viewGalleryModal').modal('show')
        let imgSrc = '/images/dropzone/' +media;
        $('#image').attr('src', imgSrc);
    }
    function deleteConfirmation(id){
        $('#deleteConfirmationModal').modal('show')

    }
    function selectCategory(serviceId){
        $('#selectCategoryModal').modal('show')
        $('#selectedServices').val(serviceId)
    }
</script>
@endsection
