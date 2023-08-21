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
                    <li class="breadcrumb-item active"> <strong> List </strong> </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card fadeIn mt-3">
        <div class="card-body">
            <strong> News List </strong>
            <div class="mt-3">
                <a href="{{route('admin.pages.news.create')}}" class="btn btn-primary btn-sm"> </i> Add News  </a>
            </div>
            <div>
                <small> <strong> </i>News Created: </strong> {{$news->count()}} </small>
            </div>
            <div class="mt-3">
                {!! $news->links() !!}
            </div>
        </div>
    </div>


    <div class="card-group mt-3 row fadeIn">
        @forelse ($news as $_news)
        <div class="col-lg-3 col-sm-6 mt-2">
            <div class="card fadeIn ml-3 h-100 ">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                  <span class="d-block">
                    <img src="{{asset('images/icons').'/'.$_news->thumbnail}}" class="img-fluid border-radius-lg" style="width:100%;height: 300px;object-fit: cover;">
                  </span>
                </div>

                <div class="card-body pt-2">
                    <div class="mt-1 mb-2">
                        <a href="#" class="btn btn-primary btn-sm" data-bs-placement="top" data-container="body" data-animation="true">
                            View
                        </a>
                        <a href="{{route('admin.pages.news.edit',$_news)}}" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="confirmDelete({{$_news->id}})">
                            Delete
                        </button>
                        <form action="{{route('admin.pages.news.delete')}}" method="post" id="deleteForm">
                            @csrf
                            <input type="hidden" name="deleteId" id="deleteId">
                        </form>
                    </div>
                    <span class="card-title h5 d-block text-darker">
                        @if ($_news->is_featured == 1)
                            <i class="fa-solid fa-star text-primary"></i>
                        @endif
                        {{$_news->headline}}
                    </span>
                    <p class="card-description mb-4">
                        {{$_news->name}}
                    </p>

                </div>
                <div class="card-footer">
                    <div class="author align-items-center">
                        @if ($_news->published_at)
                            <span class="badge badge-pill bg-gradient-success">Published</span>
                            &nbsp
                        @endif

                        <div class="stats">
                            <small>Created on {{$_news->created_at->format('M d, Y h:i a')}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <div class="card m-3">
            <div class="card-body">
                No record found
            </div>
        </div>
        @endforelse

      </div>

      <div class="card fadeIn mt-3">
        <div class="card-body">
            {!! $news->links() !!}
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
                    Are you sure you want to delete this <strong> news </strong> ?
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
