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
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.services.categories.index')}}"> <strong> Category List </strong> </a></li>
                    <li class="breadcrumb-item active" aria-current="page"><strong class="text-capitalize"> Uncategorized Service </strong> </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-body">
            <strong> <i class="fa-solid fa-layer-group"></i> Uncategorized Service List </strong>
            <div class="mt-3">
                <button class="btn btn-primary btn-sm" onclick="selectCategory()"> Reassign Services </button>
            </div>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-body">
            <div class="alert alert-primary alert-dismissible fade show text-white" role="alert" id="alertSelect">
                <span class="alert-icon"></span>
                <span class="alert-text"><strong>Notice!</strong> Please select a service first before assigning to category </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0 table-hover">
                    <thead>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Name </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Type </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action </th>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                        <tr>
                            <td style="width:60%;">
                                <a href="{{route('admin.pages.services.show',$service)}}" style="text-decoration: none">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-s">
                                            <i class="{{$service->icon}}"></i>
                                            {{$service->name}}
                                        </h6>
                                    </div>
                                </a>
                            </td>
                            <td>
                                @if ($service->type == 'service')
                                    <span class="badge bg-gradient-info ml-5">Service</span>
                                @else
                                    <span class="badge bg-gradient-warning ml-5">Product</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected-services" value="{{$service->id}}">
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3"> No record found </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal show categories for selection --}}
    <form action="{{route('admin.pages.services.categories.reassign-service')}}" method="post">
    @csrf
        <div class="modal fade" id="selectCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Assign Category </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div>
                        <small> Assign category to selected services </small>
                    </div>
                    <div class="row mt-3">
                        @forelse ($categories as $category)
                        <div class="col-sm-12">
                            <button value="{{$category->id}}" name="categoryId" class="btn btn-primary btn-sm w-100"> {{$category->name}} </button>
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
<script type="text/javascript">
    $('#alertSelect').hide()
    function selectCategory(){

        var selected = new Array();

        $("input:checkbox[name=selected-services]:checked").each(function() {
           selected.push($(this).val());
        });
        if(selected.length != 0){
            $('#selectCategoryModal').modal('show')
            $('#selectedServices').val(selected)
        }else{
            $('#alertSelect').show()
        }
    }

</script>
@endsection
