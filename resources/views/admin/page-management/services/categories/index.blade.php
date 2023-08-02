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
                </ol>
            </nav>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-header">
            <strong> Category List </strong>
            <div class="mt-3">
                <a href="{{route('admin.pages.services.categories.create')}}" class="btn btn-primary btn-sm"> Add Category  </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0 table-hover">
                    <thead>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Name </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action</th>
                    </thead>
                </table>
            </div>
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
        <div class="modal-body">
          <p> Are you sure you want to delete this introduction template? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          <button onclick="proceedDelete()" type="button" class="btn bg-gradient-primary">Confirm</button>
        </div>
      </div>
    </div>
  </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>


</script>
@endsection
