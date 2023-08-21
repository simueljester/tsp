@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-circle-info"></i> About </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"> <strong> List </strong> </li>
                </ol>
            </nav>
        </div>
    </div>
    @if ($activeViewing)
        <div class="card fadeIn mt-3">
            <div class="card-header">
                <strong> View About </strong> <a href="{{route('admin.pages.about.index')}}" style="font-size: 12px;"> Remove </a>
            </div>
            <div class="card-body">
                <div>
                    <h2> <b> {{$activeViewing->title}} </b>  </h2>
                    <p class="text-muted">
                        {!! $activeViewing->description !!}
                    </p>
                    <center>
                        <img class="about" width="250" src="{{ asset('images') }}/tsp3.png">
                    </center>
                </div>

            </div>
        </div>
    @endif
    <div class="card fadeIn mt-3">
        <div class="card-header">
            <strong> About </strong>
            <div class="mt-3">
                <a href="{{route('admin.pages.about.create')}}" class="btn btn-primary btn-sm"> </i> Add Template  </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0 table-hover">
                    <thead>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Title </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Active</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action</th>
                    </thead>
                    <tbody>
                        @forelse ($abouts as $about)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-s">
                                            {{$about->title}}
                                        </h6>
                                    </div>
                                </td>
                                <td>
                                    @if ($about->active == true)
                                        <span class="badge badge-pill bg-gradient-success">Active</span>
                                    @else
                                        <span class="badge badge-pill bg-gradient-secondary">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="javascript:;" class="text-white btn bg-primary btn-sm" onclick="viewAbout({{$about->id}})">
                                        View
                                    </a>
                                    <a href="{{route('admin.pages.about.edit',$about)}}" class="btn btn-info btn-sm">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="confirmDelete({{$about->id}})">
                                        Delete
                                    </button>
                                    <form action="{{route('admin.pages.about.delete')}}" method="post" id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="deleteId" id="deleteId">
                                    </form>
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

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <p>
                    Are you sure you want to delete this <strong> about template </strong> ?
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
              <button onclick="proceedDelete()" type="button" class="btn bg-gradient-primary">Confirm</button>
            </div>
          </div>
        </div>
      </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>


    function viewAbout(id){
        var url = '{{ route("admin.pages.about.index", ":id") }}';
        url = url.replace(':id', id);
        window.location.href = url;
    }

    function confirmDelete(id){
        $('#deleteConfirmationModal').modal('show')
        $('#deleteId').val(id)
    }

    function proceedDelete(){
        document.getElementById("deleteForm").submit();
    }

</script>
@endsection
