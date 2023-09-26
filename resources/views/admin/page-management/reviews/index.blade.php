@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-star-half-stroke"></i> Reviews </h4>
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
            <strong> Reviews </strong>
            <br>
            <small> Reviews are created from front end website </small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0 table-hover">
                    <thead>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Service </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Comment </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Rate </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Commented By </th>
                    </thead>
                    <tbody>
                        @forelse ($reviews as $review)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-s">
                                            @if ($review->service)
                                                <a href="{{route('admin.pages.services.show',$review->service->slug)}}" class="text-primary">
                                                    {{$review->service->name}}
                                                </a>
                                            @else
                                                TSP
                                            @endif
                                        </h6>

                                    </div>
                                </td>
                                <td>
                                    <p class="text-capitalize" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 500px;">
                                          {{$review->comment}}
                                    </p>
                                </td>
                                <td>
                                    @for ($i = 1; $i <= $review->rating; $i++)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @endfor
                                </td>
                                <td>
                                    <i class="fa-solid fa-user"></i> {{$review->commented_by}}
                                </td>
                                <td>
                                    <a href="javascript:;" class="text-white btn bg-primary btn-sm" onclick="viewReview({{$review}}, {{json_encode($review->created_at->format('M d, Y'))}})">
                                        View
                                    </a>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="confirmDelete({{$review->id}})">
                                        Delete
                                    </button>
                                    <form action="{{route('admin.pages.reviews.delete')}}" method="post" id="deleteForm">
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
                    {!! $reviews->links() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Delete confirmation modal --}}
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
                    Are you sure you want to delete this <strong> review </strong> ?
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
              <button onclick="proceedDelete()" type="button" class="btn bg-gradient-primary">Confirm</button>
            </div>
          </div>
        </div>
      </div>

    {{-- View Review --}}
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Review</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
                <div class="p-3">
                    <center>
                        <h1>
                            <div class="border-custom-circle text-center custom-icon-parent-2 bg-light shadow target-icon mb-3">
                                <i class="custom-icon-child-2" id="serviceIcon"></i>
                            </div>
                        </h1>
                    </center>
                </div>
                <div class="text-center">
                    <strong id="serviceName"></strong>
                    <div>
                        <i class="fa-solid fa-star text-warning"></i> x <span id="reviewRating"></span>
                    </div>
                </div>
                <div>
                    <p id="reviewComment"></p>
                </div>
                <div>
                    <i class="fa-solid fa-user"></i> <strong class="text-uppercase" id="reviewCommentedBy"></strong>
                </div>
                <div>
                    <small id="reviewCommentDate"></small>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
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

    function viewReview(review,created_at){
        $('#serviceIcon').removeClass(review.service.icon)
        $('#serviceIcon').addClass(review.service.icon)
        $('#serviceName').html(review.service.name)
        $('#reviewComment').html( '" <i>' + review.comment + '</i>"')
        $('#reviewCommentedBy').html(review.commented_by)
        $('#reviewCommentDate').html(created_at)
        $('#reviewRating').html(review.rating)
        $('#reviewModal').modal('show')
    }

</script>
@endsection
