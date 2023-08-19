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
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.services.categories.index')}}"> <strong> Category List </strong> </a></li>
                    <li class="breadcrumb-item active" aria-current="page"><strong class="text-capitalize"> {{$category->name}} Service </strong> </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-body">
            <h4> <i class="{{$category->icon}}"></i> {{$category->name}} </h4>
            <div>
                <small> {{$category->description}} </small>
            </div>
            <div class="mt-3">
                <a href="{{route('admin.pages.services.create',$category)}}" class="btn btn-primary btn-sm"> Add Service  </a>
            </div>
            <div>
                <small> <strong> </i>Services Created: </strong> {{$services->count()}} </small>
            </div>
        </div>

    </div>

    <div class="row fadeIn mt-3">
        @forelse ($services as $service)
            <div class="col-sm-4">
                <a href="{{route('admin.pages.services.show',$service)}}" style="text-decoration: none">
                    <div class="card service-card mt-3">
                        <div class="card-body ">
                             <div class="form-group ">
                                 <div class="row">
                                     <div class="col-sm-4">
                                         <div class="border-custom-circle text-center custom-icon-parent-2 bg-light shadow target-icon">
                                             <h1> <i class="{{$service->icon}} custom-icon-child-2" id="showicon"></i> </h1>
                                         </div>
                                     </div>
                                     <div class="col-sm-8">
                                         <div>
                                             <strong class="text-uppercase"> {{$service->name}} </strong>
                                         </div>
                                         <hr class="horizontal dark my-1">
                                         <div class="char-limit">
                                             {!! $service->description_clean !!}
                                         </div>
                                     </div>
                                 </div>
                             </div>
                        </div>
                        <div class="card-footer bg-light">
                             @if ($service->published_at)
                                 <span class="badge bg-gradient-dark ml-5">Published</span>

                             @endif
                             &nbsp
                            @if ($service->type == 'service')
                                <span class="badge bg-gradient-info ml-5">Service</span>
                            @else
                                <span class="badge bg-gradient-warning ml-5">Product</span>
                            @endif
                         </div>
                     </div>
                </a>
            </div>
        @empty
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        No services found
                    </div>
                 </div>
            </div>
        @endforelse

    </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>

    function confirmDelete(id){
        $('#deleteConfirmationModal').modal('show')
        $('#deleteId').val(id)
    }

    function proceedDelete(){
        document.getElementById("deleteForm").submit();
    }

</script>
@endsection
