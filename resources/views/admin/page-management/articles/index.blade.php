@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-regular fa-newspaper"></i> Articles </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"> <strong> List </strong> </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-header">
            <strong> Articles </strong>
            <div class="mt-3">
                <a href="{{route('admin.pages.articles.create')}}" class="btn btn-primary btn-sm"> </i> Add Article  </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0 table-hover">
                    <thead>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Name </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Publish </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action</th>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-s">
                                            @if ($article->is_featured == 1)
                                                <i class="fa-solid fa-star text-primary"></i>
                                            @endif
                                            {{$article->name}}
                                        </h6>
                                    </div>
                                </td>
                                <td>
                                    @if ($article->published_at)
                                        <span class="badge badge-pill bg-gradient-success">Yes</span>
                                    @else
                                        <span class="text-muted"> No </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.pages.articles.show',$article)}}" class="btn btn-primary btn-sm" data-bs-placement="top" data-container="body" data-animation="true">
                                        View Article
                                    </a>
                                    <a href="{{route('admin.pages.articles.edit',$article)}}" class="btn btn-info btn-sm">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="confirmDelete({{$article->id}})">
                                        Delete
                                    </button>
                                    <form action="{{route('admin.pages.articles.delete')}}" method="post" id="deleteForm">
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
                <div class="mt-2">
                    {!! $articles->links() !!}
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
            <div class="modal-body text-center">
                <i class="fa-solid fa-triangle-exclamation fa-3x text-warning fa-fade"></i>
                <p>
                    Are you sure you want to delete this article? You may <strong> remove publish instead </strong>.
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

    function confirmDelete(id){
        $('#deleteConfirmationModal').modal('show')
        $('#deleteId').val(id)
    }

    function proceedDelete(){
        document.getElementById("deleteForm").submit();
    }

</script>
@endsection
